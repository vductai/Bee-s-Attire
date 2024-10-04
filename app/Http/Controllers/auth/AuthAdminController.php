<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\LoginAdminRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class AuthAdminController extends Controller
{
    public function getProfile(){

        if (Auth::check()){
            return Auth::user();
        }
    }

    public function dashboard(){
        return view('admin.dashboard');
    }

    public function viewLoginAdmin(){
        return view('admin.auth.login-admin');
    }

    public function loginAdmin(LoginAdminRequest $request){

        $loginCustomers = $request->only('email', 'password');

        if (Auth::attempt($loginCustomers)) {
            $user = Auth::user();
            // tao token
            $token = $user->createToken('MyAppToken')->plainTextToken;
            return redirect()->route('dashboard');
        }
    }

    public function logoutAdmin() {
        // Xoá token của user đang đăng nhập
        if (Auth::guard('web')->check()){
            $user = Auth::guard('web')->user();
            $user->tokens()->delete();
            Auth::guard('web')->logout();
            Session::flush(); // Xóa toàn bộ dữ liệu session

            // Xóa cookie liên quan đến xác thực
            Cookie::queue(Cookie::forget('sanctum_token'));

            return redirect()->route('admin.viewLogin');
        }

    }
}
