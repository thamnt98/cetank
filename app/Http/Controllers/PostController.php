<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Section;
use App\Models\Category;
use App\Models\CrawalPost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\Models\Admin;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $page_title = "All Post";
        $testimonial = Post::orderBy('created_at', 'desc');
        if (Auth::guard('admin')->user()->role_id == 2) {
            $testimonial = $testimonial->where('user_id', Auth::guard('admin')->user()->id);
        }
        $testimonial = $testimonial->get()->map(function ($post) {
            if ($post->approved_by) {
                $user =  Admin::where('id', $post->approved_by)->first();
                $post->approved_person  = $user ? $user->name : null;
            } else {
                $post->approved_person = null;
            }
            return $post;
        });
        $basic = Section::first();
        $role_id = Auth::guard('admin')->user()->role_id;
        $user_id = Auth::guard('admin')->user()->id;
        return view('post.index', compact(['page_title', 'testimonial', 'basic', 'role_id', 'user_id']));
    }

    public function edit($id)
    {
        $category = Category::whereStatus(1)->get();
        $page_title = "Edit Post";
        $testimonial = Post::findOrFail($id);
        $basic = Section::first();
        $role_id = Auth::guard('admin')->user()->role_id;
        return view('post.edit', compact(['category', 'page_title', 'testimonial', 'basic', 'role_id']));
    }


    public function update(Request $request)
    {
        $r = Post::find($request->id);
        $request->validate([
            'title' => 'required|unique:posts,title,' . $r->id,
            'category' => 'required',
            'image' => 'nullable|mimes:png,jpeg,jpg',
            'tags' => 'required',
            'description' => 'required',
        ]);
        $data['user_id'] = $request->userId;
        $data['category_id'] = $request->category;
        $data['title'] = $request->title;
        $data['slug'] = Str::slug($request->title);
        $data['tags'] = $request->tags;
        $data['description'] = $request->description;
        $data['status'] = $request->fetured == 'on' ? '1' : '0';
        if ($data['status'] == 1) {
            $data['approved_by'] = Auth::guard('admin')->user()->id;
        }

        if ($request->hasFile('image')) {
            File::delete(('images/post') . '/' . $r->image);
            $image = $request->file('image');
            $image_name = Str::random(20);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $location = ('images/post') . '/' . $image_full_name;
            Image::make($image)->resize(800, 540)->save($location);
            $data['image'] = $image_full_name;
        }
        $r->update($data);
        session()->flash('message', 'Post Update Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        $testimonial = Post::findOrFail($request->id);
        File::delete(('images/post') . '/' . $testimonial->image);
        $testimonial->delete();
        session()->flash('message', 'Post Deleted Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }


    public function publish(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        $data = Post::findOrFail($request->id);
        if ($data->status == 1) {
            $data->status = 0;
            $data->approved_by = null;
            $data->save();
            session()->flash('message', 'Post Unpublish Successfully.');
            Session::flash('type', 'success');
            Session::flash('title', 'Success');
        } else {
            $data->status = 1;
            $data->approved_by = Auth::guard('admin')->user()->id;
            $data->save();
            session()->flash('message', 'Post Publish Successfully.');
            Session::flash('type', 'success');
            Session::flash('title', 'Success');
        }
        return redirect()->back();
    }

    public function create()
    {
        $data['category'] = Category::whereStatus(1)->get();
        $data['page_title'] = "Create New Post";
        $data['basic'] = Section::first();
        $data['role_id'] = Auth::guard('admin')->user()->role_id;
        return view('post.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:posts,title',
            'category' => 'required',
            'image' => 'nullable|mimes:png,jpeg,jpg',
            'tags' => 'required',
            'description' => 'required',
        ]);

        $data['user_id'] = $request->userId;
        $data['category_id'] = $request->category;
        $data['title'] = $request->title;
        $data['slug'] = Str::slug($request->title);
        $data['tags'] = $request->tags;
        $data['description'] = $request->description;
        $data['status'] = $request->fetured == 'on' ? '1' : '0';
        if ($data['status'] == 1) {
            $data['approved_by'] = $request->userId;
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = Str::random(20);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $location = ('images/post') . '/' . $image_full_name;
            Image::make($image)->resize(800, 540)->save($location);
            $data['image'] = $image_full_name;
        }
        Post::create($data);
        if ($request->post_id) {
            $testimonial = CrawalPost::findOrFail($request->post_id);
            $testimonial->delete();
        }
        session()->flash('message', 'Post Created Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->route('post.all');
    }
}
