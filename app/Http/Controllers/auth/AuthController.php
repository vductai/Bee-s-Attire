<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function index()
    {

        try {
            $this->authorize('viewAny', User::class);
        } catch (AuthorizationException $e) {
        }
        $user = User::all();
        return response()->json([
            'message' => 'list user',
            'data' => $user
        ]);
    }


    public function register(UserRequest $request)
    {

        $username = 'user_' . rand(1000, 9999);

        $create = User::create([
            'username' => $username,
            'password' => $request->password,
            'email' => $request->email,
            'role_id' => 3
        ]);

        // Gửi email chào mừng
        Mail::to($create->email)->send(new WelcomeMail($create));

        return response()->json([
            'message' => 'fall',
            'data' => $create
        ]);

    }

    public function getProfile(){
        if (Auth::check()){
           return Auth::user();
        }
    }


    public function login(UserRequest $request){

        $loginCustomers = $request->only('email', 'password');

        if (Auth::attempt($loginCustomers)) {
            // lay tt user
            $user = Auth::user();
            // tao token
            $token = $user->createToken('MyAppToken')->plainTextToken;

            return response()->json([
                'token' => $token
            ]);
        }
    }

    public function logout() {
        // Xoá token của user đang đăng nhập
        $user = Auth::user();
        $user->currentAccessToken()->delete();

        return redirect()->route('loginAdmin');
    }


    public function resetPassword(UserRequest $request){

    }


}
