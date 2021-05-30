<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\ForgotPassword;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\PasswordReset;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class ForgotPasswordController extends Controller
{
    public function email()
    {
        return view('admin.password.email');
    }

    public function verify(Request $request)
    {
        $email = $request->email;
        $isValid = $this->validateEmail(['email' => $email]);
        if ($isValid->fails()) {
            return redirect()->back()->withErrors($isValid->errors())->withInput();
        }
        try {
            DB::beginTransaction();
            $token = $this->createToken($email);
            Mail::to($email)->send(new ForgotPassword($email, $token));
            DB::commit();
            return back()->with('success', "We have sent you an email to reset password. Please check your inbox or spam");
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
            return back()->with('error', 'Something went wrong');
        }
    }

    public function reset(Request $request){
        $email = $request->email;
        $token = $request->token;
        return view('admin.password.reset', compact('email', 'token'));
    }

    public function update(Request $request){
        $data = $request->all();
        $validate = $this->validatePassword($data);
        if ($validate->fails()) {
            return back()->withErrors($validate->errors());
        }
        $password = Hash::make($data['password']);
        Admin::where('email', $data['email'])
            ->update(['password' => $password]);
        session()->flash('message', 'You updated password successfully');
        return redirect('/admin/login');
    }

    public function validateEmail($data)
    {
        return Validator::make(
            $data,
            [
                'email' => 'bail|required|exists:admins'
            ]
        );
    }

    private function createToken($email)
    {
        $key = config('app.key');
        if (Str::startsWith($key, 'base64:')) {
            $key = base64_decode(substr($key, 7));
        }
        $token = hash_hmac('sha256', Str::random(40), $key);
        PasswordReset::updateOrCreate(
            ['email' => $email],
            [
                'token' => $token,
                'email' =>  $email,
                'created_at' => Carbon::now()
            ]
        );
        return $token;
    }

    private function validatePassword($data)
    {
        return Validator::make(
            $data,
            [
                'email' => 'required|email',
                'token' => 'required|string',
                'password' => 'required|regex:/[A-z0-9]{8,}/',
                'password_confirmation' => ['required', 'same:password']
            ]
        );
    }
}