<?php

namespace App\Http\Controllers;
use App\Models\Signal;
use App\Models\Post;
use App\Models\Category;
use App\Models\Section;
use App\Models\User;
use Illuminate\Support\Carbon;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function getDashboard()
    {

        $data['page_title'] = "Dashboard";
        $data['signal'] = Signal::all()->count();
        $data['blog'] = Post::all()->count();
        $data['category'] = Category::all()->count();
        $data['user'] = User::all()->count();
        $data['basic'] = Section::first();
        $start = Carbon::parse()->subDays(19);
        $end = Carbon::now();
        $stack = [];
        $date = $start;
        while ($date <= $end) {
            $stack[] = $date->copy();
            $date->addDays(1);
        }
        $dL = [];
        $dV = [];
        foreach (array_reverse($stack) as $d){
            $dL[] .= Carbon::parse($d)->format('dS M');

        }
        foreach (array_reverse($stack) as $d){
            $date = Carbon::parse($d)->format('Y-m-d');
            $start = $date.' '.'00:00:00';
            $end = $date.' '.'23:59:59';
            $dC= Signal::whereBetween('created_at',[$start,$end])->get();
            $dV[] .= count($dC);
        }
        $data['dV'] = $dV;
        $data['dL'] = $dL;
        return view('dashboard.dashboard',$data);
    }
}
