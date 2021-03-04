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
        $data['category'] = Category::whereStatus(1)->get();
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
        $data['menus'] = Menu::all();
        $data['footer_category'] = Category::whereStatus(1)->take(7)->get();
        $data['footer_blog'] = Post::orderBy('views', 'desc')->take(7)->get();
        $data['section'] = Section::first();
        $data['basic'] = Section::first();
        $request = Http::get('https://fxsignals.fxleaders.de/api/FXL/5');
        $data['trades'] = $request->json();
        $data['stock_blog'] = Post::where('category_id', 1)->take(10)->orderBy('created_at', 'desc')->get();
        $data['other_blog']  =  Post::where('category_id', '!=',1)->take(10)->orderBy('created_at', 'desc')->get();
        $data['right_blog'] = Menu::where('id', 1)->first();
        return view('home.home', $data);
    }

    public function getMenu($id, $slug)
    {
        $data['men'] = Menu::whereId($id)->first();
        $data['page_title'] = $data['men']->name;
        $data['menus'] = Menu::all();
        $data['social'] = Social::all();
        $data['basic'] = BasicSetting::first();
        $data['category'] = Category::whereStatus(1)->get();
        $data['footer_category'] = Category::whereStatus(1)->take(7)->get();
        $data['footer_blog'] = Post::orderBy('views', 'desc')->take(7)->get();
        return view('home.menus', $data);
    }
}
