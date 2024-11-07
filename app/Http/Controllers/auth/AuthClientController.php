<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\client\LoginRequest;
use App\Http\Requests\client\RegisterRequest;
use App\Jobs\DeleteUnverifiedUser;
use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class AuthClientController extends Controller
{
    public function viewRegister()
    {
        return view('client.auth.register');
    }

    public function viewLogin()
    {
        return view('client.auth.login');
    }


    public function register(RegisterRequest $request)
    {

        $username = 'user_' . rand(1000, 9999);


        $create = User::create([
            'username' => $username,
            'password' => $request->password,
            'email' => $request->email,
            'role_id' => 3,
            'email_verified_at' => null
        ]);

        // Tạo URL xác minh
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(5), // thoi gian xác thực
            ['id' => $create->user_id, 'hash' => sha1($create->email)]
        );


        // Gửi email xác minh
        Mail::to($create->email)->send(new WelcomeMail($create, $verificationUrl));

        // Dispatch job xóa tài khoản sau 2 phút
        DeleteUnverifiedUser::dispatch($create->user_id)->delay(now()->addMinutes(6));

        $email = $create->email;
        return view('client.auth.message.verify-email', compact('email'));

    }

    public function loginClient(LoginRequest $request){
        $loginCustomers = $request->only('email', 'password');
        if (Auth::attempt($loginCustomers)) {
            $user = Auth::user();
            if ($user && is_null($user->email_verified_at)) {
                Auth::guard('web')->logout();
                session()->put('errorsLogin', 'Tài khoản này chưa được xác minh, vui lòng xác minh email để tiếp tục');
                return redirect()->route('client-viewLogin')->withErrors([]);
            }

            if ($user && $user->action == 0){
                Auth::guard('web')->logout();
                session()->put('errorsLogin', 'Tài khoản này đã bị vô hiệu hoá');
                return redirect()->route('client-viewLogin');
            }

            $user->createToken('MyAppToken')->plainTextToken;
            return redirect()->route('home');
        } else {
            session()->put('errorsLogin', 'Email hoặc mật khẩu không đúng');
            return redirect()->route('client-viewLogin');
        }
    }


    public function logoutClient() {
        // Xoá token của user đang đăng nhập
        if (Auth::guard('web')->check()){
            $user = Auth::guard('web')->user();
            $user->tokens()->delete();
            Auth::guard('web')->logout();
            Session::flush(); // Xóa toàn bộ dữ liệu session
            // Xóa cookie liên quan đến xác thực
            Cookie::queue(Cookie::forget('sanctum_token'));

            return redirect()->route('home');
        }

    }
}
