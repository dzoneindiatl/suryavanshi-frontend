<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User; 
use Illuminate\Support\Facades\Cookie;

class SocialAuthController extends Controller
{
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallBack()
    {
        $googleUser = Socialite::driver('google')->user();

        $customer = User::updateOrCreate(
            [
                'email' => $googleUser->getEmail(),
            ],
            [
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'profile_image' => $googleUser->getAvatar(),
            ]
        );

        if (!$customer->hasRole('customer')) {
            $customer->assignRole('customer');
        }

        Auth::guard('customer')->login($customer, true);

        return redirect('/');
    }

    public function redirectToFacebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback(){
        $facebookUser = Socialite::driver('facebook')->user();
        $customer = User::updateOrCreate(
            [
                'email' => $facebookUser->getEmail(),
            ],
            [
                'name' => $facebookUser->getName(),
                'facebook_id' => $facebookUser->getId(),
                'profile_image' => $facebookUser->getAvatar(),
            ]
        );
        if (!$customer->hasRole('customer')) {
            $customer->assignRole('customer');
        }
        Cookie::queue('user_email',$customer->email,60 * 24 * 15);
        Auth::guard('customer')->login($customer);
        return redirect('/');
    }


}
