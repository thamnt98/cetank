<?php

namespace App\Http\Controllers;

use App\Models\BasicSetting;
use App\Models\Category;
use App\Models\Testimonial;
use App\Models\Member;
use App\Models\Speciality;
use App\Models\Plan;
use App\Models\User;
use App\Models\Post;
use App\Models\Signal;
use App\Models\Social;
use App\Models\Partner;
use App\Models\Menu;
use App\Models\Section;
use Illuminate\Support\Facades\Http;
class HomeController extends Controller
{
    public function getIndex()
    {
        $data['page_title'] = "Home Page";
        $data['category'] = Category::whereStatus(1)->where('id', '!=', 1)->get();
        foreach($data['category'] as $key =>  $c){
            $data['category'][$key]['child'] = Category::where('parent_id', $c->id)->whereStatus(1)->get();
        }
        $data['testimonial'] = Testimonial::all();
        $data['member'] = Member::all();
        $data['speciality'] = Speciality::all();
        $data['plan'] = Plan::whereStatus(1)->get();
        $data['total_user'] = User::all()->count();
        $data['total_category'] = Category::all()->count();
        $data['total_blog'] = Post::all()->count();
        $data['total_signal'] = Signal::all()->count();
        $data['social'] = Social::all();
        $data['partner'] = Partner::all();
        $data['blog'] = Post::latest()->take(6)->get();
        $data['menus'] = Category::all();
        $data['footer_category'] = Category::whereStatus(1)->take(5)->get();
        $data['footer_blog'] = Post::orderBy('views', 'desc')->take(5)->get();
        $data['section'] = Section::first();
        $data['basic'] = Section::first();
        $request = Http::get('https://fxsignals.fxleaders.de/api/FXL/5');
        $data['trades'] = $request->json();
        $data['stock_blog'] = Post::where('category_id', 4)->take(5)->orderBy('created_at', 'desc')->get();
        foreach($data['stock_blog'] as $key => $blog){
            $data['stock_blog'][$key]['tags'] = explode(',', $blog->tags);
        }
        $data['stock_blog_slug'] = Category::where('id', 4)->first()->slug;
        $data['other_blog']  =  Post::whereIn('category_id', [5,6,7])->take(5)->orderBy('created_at', 'desc')->get();
        foreach($data['other_blog'] as $key => $blog){
            $data['other_blog'][$key]['tags'] = explode(',', $blog->tags);
        }
        $data['other_blog_slug']  =  Category::whereIn('id', [5,6,7])->pluck('slug')->toArray();
        $data['other_blog_slug'] = implode("+", $data['other_blog_slug']);
        $data['right_blog'] = Post::where('category_id', 8)->take(9)->orderBy('created_at', 'desc')->get();
        if(count($data['right_blog'])){
            $data['top_right_blog'] = $data['right_blog'][0];
            unset($data['right_blog'][0]);
        }
        $data['footer_blog_1'] = Post::where('category_id', 9)->orderBy('created_at', 'desc')->take(9)->get();
        $data['footer_blog_2'] = Post::where('category_id', 11)->orderBy('created_at', 'desc')->take(9)->get();
        $data['footer_blog_3'] = Post::where('category_id', 12)->orderBy('created_at', 'desc')->take(9)->get();
        return view('home.home', $data);
    }

    public function getMenu($id, $slug)
    {
//        $data['men'] = Menu::whereId($id)->first();
//        $data['page_title'] = $data['men']->name;
        $data['menus'] = Category::all();
        $data['social'] = Social::all();
        $data['basic'] = BasicSetting::first();
        $data['category'] = Category::whereStatus(1)->get();
        $data['footer_category'] = Category::whereStatus(1)->take(7)->get();
        $data['footer_blog'] = Post::orderBy('views', 'desc')->take(7)->get();
        return view('home.menus', $data);
    }

    public function detailsBlog($slug)
    {
        $data['page_title'] = 'Blog Details';
        $data['blog'] = Post::whereSlug($slug)->first();
        $data['blog']['tags'] = explode(',', $data['blog']->tags);
        $data['basic'] = BasicSetting::first();
        // $data['blog']->views = $data['blog']->views +1;
        $data['category'] = Category::whereStatus(1)->where('id', '!=', 1)->get();
        foreach($data['category'] as $key =>  $c){
            $data['category'][$key]['child'] = Category::where('parent_id', $c->id)->whereStatus(1)->get();
        }
        $data['social'] = Social::all();
        $data['popular'] = Post::orderBy('views','desc')->take(10)->get();
        $data['menus'] = Category::all();
        $data['footer_category'] = Category::whereStatus(1)->take(7)->get();
        $data['footer_blog'] = Post::orderBy('views','desc')->take(7)->get();
        $data['meta'] = 2;
        return view('home.blog-details',$data);
    }

    public function getPostByTag($tag){
        $data['page_title'] = 'Blog Details';
        $data['slug'] = str_replace('-', ' ',  $tag);
        $data['blog'] = Post::where('tags', 'like', '%'. $tag . '%')->orderBy('created_at', 'desc')->get();
        foreach($data['blog'] as $key => $blog){
            $data['blog'][$key]['tags'] = explode(',', $blog->tags);
            $description = strip_tags(html_entity_decode($blog->description));
            $pos = strpos($description, '.');
            $data['blog'][$key]['description'] =  substr($description, 0, $pos+1);
        }
        $data['category'] = Category::whereStatus(1)->where('id', '!=', 1)->get();
        foreach($data['category'] as $key =>  $c){
            $data['category'][$key]['child'] = Category::where('parent_id', $c->id)->whereStatus(1)->get();
        }
        $data['basic'] = BasicSetting::first();
        $data['social'] = Social::all();
        $data['menus'] = Category::all();
        $data['footer_blog'] = Post::orderBy('views','desc')->take(7)->get();
        $data['footer_category'] = Category::whereStatus(1)->take(7)->get();
        $data['basic'] = BasicSetting::first();
        return view('home.blog-list', $data);
    }
    public function getList($categorySlugs)
    {
        $data['slug'] = Category::where('slug', $categorySlugs)->first();
        $data['social'] = Social::all();
        $data['menus'] = Category::all();
        $data['footer_blog'] = Post::orderBy('views','desc')->take(7)->get();
        $data['footer_category'] = Category::whereStatus(1)->take(7)->get();
        $data['basic'] = BasicSetting::first();
        $data['category'] = Category::whereStatus(1)->where('id', '!=', 1)->get();
        foreach($data['category'] as $key =>  $c){
            $data['category'][$key]['child'] = Category::where('parent_id', $c->id)->whereStatus(1)->get();
        }
        if($data['slug']){
            $data['slug'] = $data['slug']->name;
            $categorySlugs = explode('+', $categorySlugs);
            $categoryIds = Category::whereIn('slug', $categorySlugs)->pluck('id');
            $data['blog'] = Post::whereIn('category_id', $categoryIds)->orderBy('created_at', 'desc')->get();
            foreach($data['blog'] as $key => $blog){
                $data['blog'][$key]['tags'] = explode(',', $blog->tags);
                $description = strip_tags(html_entity_decode($blog->description));
                $pos = strpos($description, '.');
                $data['blog'][$key]['description'] =  substr($description, 0, $pos+1);
            }
        }
        else{
            $data['blog'] = null;
        }
        return view('home.blog-list', $data);
    }
}
