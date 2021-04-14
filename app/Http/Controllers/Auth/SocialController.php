<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use http\Env\Url;
use Intervention\Image\Facades\Image;
use Socialite;
use File;
use App\Models\User;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function callback($provider)
    {
        $getInfo = Socialite::driver($provider)->user();
        $user = $this->createUser($getInfo,$provider);
        auth()->login($user);
        return redirect()->route('home');
    }
    function createUser($getInfo,$provider){
        $user = User::where('provider_id', $getInfo->id)->first();
        $image = $getInfo->avatar ."&access_token={$getInfo->token}";
        $fileContents = file_get_contents($image);
        $img = env('APP_URL') . 'images/'. $getInfo->id . ".jpg";
        $image = file_put_contents($img, $fileContents);
        if (!$user) {
            $user = User::create([
                'name'     => $getInfo->name,
                'email'    => $getInfo->email,
                'provider' => $provider,
                'provider_id' => $getInfo->id,
                'image' =>  $getInfo->id . ".jpg"
            ]);
        }
        return $user;
    }
}
