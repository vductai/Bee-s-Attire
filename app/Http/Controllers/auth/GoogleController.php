<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;
class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'username' => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt('your-random-password') // Không cần thiết, chỉ để tránh lỗi
                ]
            );
            Auth::login($user);
            return redirect()->route('home');
        } catch (Exception $e) {
            return redirect()->route('client-login')->with('error', 'Có lỗi xảy ra trong quá trình đăng nhập Google');
        }
    }
}