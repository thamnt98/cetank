<?php

namespace App\Http\Controllers;

use App\Models\BasicSetting;
use App\Models\Category;
use App\Models\Comment;
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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use function GuzzleHttp\Psr7\str;

class HomeController extends Controller
{
    public function getIndex()
    {
        $data['page_title'] = "Home Page";
        $data['basic'] = BasicSetting::first();
        $data['category'] = Category::whereStatus(1)->where('id', '!=', 1)->get();
        foreach ($data['category'] as $key => $c) {
            $data['category'][$key]['child'] = Category::where('parent_id', $c->id)->whereStatus(1)->get();
        }
        $data['testimonial'] = Testimonial::all();
        $data['member'] = Member::all();
        $data['speciality'] = Speciality::all();
        $data['plan'] = Plan::whereStatus(1)->get();
        $data['total_user'] = User::all()->count();
        $data['total_category'] = Category::all()->count();
        $data['total_signal'] = Signal::all()->count();
        $data['social'] = Social::all();
        $data['partner'] = Partner::all();
        $data['blog'] = Post::where('status', 1)->latest()->take(6)->get();
        $data['menus'] = Category::all();
        $data['footer_category'] = Category::whereStatus(1)->take(5)->get();
        $data['footer_blog'] = Post::where('status', 1)->orderBy('views', 'desc')->take(5)->get();
        $data['section'] = Section::first();
        // $request = Http::get('https://fxsignals.fxleaders.de/api/FXL/5');
        // $data['trades'] = $request->json();
        $data['stock_blog'] = Post::where('status', 1)->where('category_id', 4)->take(5)->orderBy('created_at', 'desc')->get();
        foreach ($data['stock_blog'] as $key => $blog) {
            $data['stock_blog'][$key]['tags'] = explode(',', $blog->tags);
        }
        $data['stock_blog_slug'] = Category::where('id', 4)->first()->slug;
        $data['other_blog'] = Post::where('status', 1)->whereIn('category_id', [5, 6, 7])->take(5)->orderBy('created_at', 'desc')->get();
        foreach ($data['other_blog'] as $key => $blog) {
            $data['other_blog'][$key]['tags'] = explode(',', $blog->tags);
        }
        $data['other_blog_slug'] = Category::whereIn('id', [5, 6, 7])->pluck('slug')->toArray();
        $data['other_blog_slug'] = implode("+", $data['other_blog_slug']);
        $data['right_blog'] = Post::where('status', 1)->where('category_id', 8)->take(9)->orderBy('created_at', 'desc')->get();
        if (count($data['right_blog'])) {
            $data['top_right_blog'] = $data['right_blog'][0];
            unset($data['right_blog'][0]);
        }
        $data['top_right_blog'] = null;
        $data['footer_blog_1'] = Post::where('status', 1)->where('category_id', 9)->orderBy('created_at', 'desc')->take(9)->get();
        $data['footer_blog_2'] = Post::where('status', 1)->where('category_id', 11)->orderBy('created_at', 'desc')->take(9)->get();
        $data['footer_blog_3'] = Post::where('status', 1)->where('category_id', 12)->orderBy('created_at', 'desc')->take(9)->get();
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
        $data['footer_blog'] = Post::where('status', 1)->orderBy('views', 'desc')->take(7)->get();
        return view('home.menus', $data);
    }

    public function detailsBlog($slug)
    {
        $data['page_title'] = 'Blog Details';
        $data['blog'] = Post::where('status', 1)->whereSlug($slug)->first();
        $data['blog']['tags'] = explode(',', $data['blog']->tags);
        $data['basic'] = BasicSetting::first();
        // $data['blog']->views = $data['blog']->views +1;
        $data['category'] = Category::whereStatus(1)->where('id', '!=', 1)->get();
        foreach ($data['category'] as $key => $c) {
            $data['category'][$key]['child'] = Category::where('parent_id', $c->id)->whereStatus(1)->get();
        }
        $data['social'] = Social::all();
        $data['popular'] = Post::where('status', 1)->orderBy('views', 'desc')->take(10)->get();
        $data['menus'] = Category::all();
        $data['footer_category'] = Category::whereStatus(1)->take(7)->get();
        $data['footer_blog'] = Post::where('status', 1)->orderBy('views', 'desc')->take(7)->get();
        $data['meta'] = 2;
        return view('home.blog-details', $data);
    }

    public function getPostByTag($tag)
    {
        $data['page_title'] = 'Blog Details';
        $data['title'] = 'Cetank - Tin tức về chứng khoán, forex, bitcoin và hàng hóa';
        $data['slug'] = str_replace('-', ' ', $tag);
        $data['blog'] = Post::where('status', 1)->where('tags', 'like', '%' . $tag . '%')->orderBy('created_at', 'desc')->get();
        foreach ($data['blog'] as $key => $blog) {
            $data['blog'][$key]['tags'] = explode(',', $blog->tags);
            $description = strip_tags(html_entity_decode($blog->description));
            $pos = strpos($description, '.');
            $data['blog'][$key]['description'] = substr($description, 0, $pos + 1);
        }
        $data['category'] = Category::whereStatus(1)->where('id', '!=', 1)->get();
        foreach ($data['category'] as $key => $c) {
            $data['category'][$key]['child'] = Category::where('parent_id', $c->id)->whereStatus(1)->get();
        }
        $data['social'] = Social::all();
        $data['menus'] = Category::all();
        $data['footer_blog'] = Post::where('status', 1)->orderBy('views', 'desc')->take(7)->get();
        $data['footer_category'] = Category::whereStatus(1)->take(7)->get();
        $data['basic'] = BasicSetting::first();
        return view('home.blog-list', $data);
    }

    public function getList($categorySlugs)
    {
        switch ($categorySlugs) {
            case 'phan-tich-nhan-dinh' :
                {
                    $data['title'] = 'Cetank - Phân tích, Đánh giá về chứng khoán, forex, bitcoin và hàng hóa';
                    break;
                }
            case 've-cetank':
            case 'about-us':
                {
                    $data['title'] = 'Cetank - Giới thiệu';
                    break;
                }
            case 'dinh-gia-doanh-nghiep':
                {
                    $data['title'] = 'Cetank - Định giá doanh nghiệp';
                    break;
                }
            case 'robot-signal':
                {
                    $data['title'] = 'Cetank - Robot Signal, EA Forex, Code Amibroker';
                    break;
                }
            case 'tien-dien-tu':
                {
                    $data['title'] = 'Cetank - Tin tức Bitcoin, ETH';
                    break;
                }
            default:
                $data['title'] = 'Cetank - Tin tức về chứng khoán, forex, bitcoin và hàng hóa';
        }
        $data['slug'] = Category::where('slug', $categorySlugs)->get();
        $data['social'] = Social::all();
        $data['menus'] = Category::all();
        $data['footer_blog'] = Post::where('status', 1)->orderBy('views', 'desc')->take(7)->get();
        $data['footer_category'] = Category::whereStatus(1)->take(7)->get();
        $data['basic'] = BasicSetting::first();
        $data['category'] = Category::whereStatus(1)->where('id', '!=', 1)->get();
        foreach ($data['category'] as $key => $c) {
            $data['category'][$key]['child'] = Category::where('parent_id', $c->id)->whereStatus(1)->get();
        }
        $data['blog'] = null;
        $slugs = [];
        if ($data['slug']) {
            $slugs = [$categorySlugs];
        }
        if (strpos($categorySlugs, '+')) {
            $slugs = explode('+', $categorySlugs);
        }
        if (!empty($slugs)) {
            $categories = Category::whereIn('slug', $slugs)->pluck('name', 'id')->toArray();
            $data['slug'] = implode(", ", $categories);
            $data['blog'] = Post::where('status', 1)->whereIn('category_id', array_keys($categories))->orderBy('created_at', 'desc')->get();
            foreach ($data['blog'] as $key => $blog) {
                $data['blog'][$key]['tags'] = explode(',', $blog->tags);
                $description = strip_tags(html_entity_decode($blog->description));
                $pos = strpos($description, '.');
                $data['blog'][$key]['description'] = substr($description, 0, $pos + 1);
            }
        }
        return view('home.blog-list', $data);
    }

    public function createComment(Request $request){
        if(is_null(Auth::user())){
           return  redirect('/auth/redirect/facebook');
        }
        // $request->validate([
        //     'content' => 'required'
        // ]);
        $input= $request->all();

        $input['user_id'] = Auth::user()->id;
        if (isset($input['parent_id'])) {
            $input['level'] = 2;
        } else {
            $input['level'] = 1;
        }
        Comment::create($input);
        return redirect()->back();
    }
}
