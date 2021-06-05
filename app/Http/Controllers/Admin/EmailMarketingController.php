<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\BasicSetting;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailMarketing;
use Illuminate\Support\Facades\Session;

class EmailMarketingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $data['basic'] = BasicSetting::first();
        $data['page_title'] = "Email Marketing";
        $path = '/home/keynesac/cetank.net/app/Mail/templates.json';
        $templates = file_get_contents($path);
        $data['templates'] = [];
        if ($templates) {
            $data['templates'] = json_decode($templates);
        }
        $data['emails'] = Admin::pluck('email');
        return view('admin.email-marketing', $data);
    }

    public function send(Request $request)
    {
        $this->validate($request, [
            'template_email' => 'required',
            'title' => 'required|max:255',
            'customers' => 'required|array',
        ]);
        try {
            Mail::to($request['customers'])->send(new EmailMarketing($request['template_email'], $request['title']));
            session()->flash('message', 'Gửi email thành công');
            Session::flash('type', 'success');
            Session::flash('title', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Gửi email thất bại');
        }
    }
}
