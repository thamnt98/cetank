<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
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

class HomeController extends Controller
{
    public function getIndex()
    {
        $data['page_title'] = "Home Page";
        $data['slider'] = Slider::all();
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
        return view('home.home', $data);
    }
}
