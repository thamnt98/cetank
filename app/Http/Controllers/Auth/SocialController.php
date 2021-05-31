<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function callback($provider)
    {
        $getInfo = Socialite::driver($provider)->stateless()->user();
        $user = User::where('provider_id', $getInfo->id)->first();
        if (is_null($user)) {
            $image = $getInfo->avatar . "&access_token={$getInfo->token}";
            $fileContents = file_get_contents($image);
            $img = env('APP_URL') . 'images/' . $getInfo->id . ".jpg";
            $image = file_put_contents($img, $fileContents);
            $user = User::create([
                'name'     => $getInfo->name,
                'email'    => $getInfo->email,
                'provider' => $provider,
                'provider_id' => $getInfo->id,
                'image' =>  $getInfo->id . ".jpg",
                'password' => Hash::make(Str::random(8))
            ]);
        }
        $data = [
            'email' => $user->email,
            'password' => $user->password
        ];
        Auth::login($user);
        return redirect(url()->previous());
    }
}
