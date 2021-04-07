<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\Admin;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $page_title = "All Staff";
        $staffs = Admin::orderBy('created_at', 'desc')->where('role_id', '!=', 1)->get();
        $basic = Section::first();
        return view('admin.list', compact(['page_title', 'staffs', 'basic']));
    }

    public function edit($id)
    {
        $page_title = "Edit Staff";
        $staff = Admin::findOrFail($id);
        $basic = Section::first();
        return view('admin.edit', compact(['page_title', 'staff', 'basic']));
    }


    public function update(Request $request)
    {
        $staff = Admin::find($request->id);
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|mimes:png,jpeg,jpg',
            'role_id' => 'required',
            'phone' => 'nullable|regex:/[0-9]{10,11}/'
        ]);
        $data['email'] = $data['username'] = $request->email;
        $data['phone'] = $request->phone;
        $data['name'] = $request->name;
        $data['role_id'] = $request->role_id;
        if ($request->hasFile('image')) {
            if($staff->image){
                File::delete(('images/admin') . '/' . $staff->image);
            }
            $image = $request->file('image');
            $image_name = Str::random(20);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $location = ('images/admin') . '/' . $image_full_name;
            Image::make($image)->resize(800, 540)->save($location);
            $data['image'] = $image_full_name;
        }
        $staff->update($data);
        session()->flash('message', 'Staff Update Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        $staff = Admin::findOrFail($request->id);
        File::delete(('images/admin') . '/' . $staff->image);
        $staff->delete();
        session()->flash('message', 'Staff Deleted Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }


    public function create()
    {
        $data['page_title'] = "Create New Staff";
        $data['basic'] = Section::first();
        return view('admin.create', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:admins,email',
            'name' => 'required',
            'image' => 'nullable|mimes:png,jpeg,jpg',
            'role_id' => 'required',
            'phone' => 'nullable|regex:/[0-9]{10,11}/'
        ]);
        $data['email'] = $data['username'] = $request->email;
        $data['phone'] = $request->phone;
        $data['name'] = $request->name;
        $data['role_id'] = $request->role_id;
        $data['password'] = Hash::make('admin1234');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = Str::random(20);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $location = ('images/admin') . '/' . $image_full_name;
            Image::make($image)->resize(800, 540)->save($location);
            $data['image'] = $image_full_name;
        }
        Admin::create($data);
        session()->flash('message', 'Staff Created Successfully.');
        Session::flash('type', 'success');
        Session::flash('title', 'Success');
        return redirect()->back();
    }
}
