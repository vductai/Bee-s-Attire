<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\userRequest;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

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

//        if ($request->hasFile('avatar')) {
//            $file = $request->file('avatar');
//            $filename = time() . '.' . $file->getClientOriginalExtension();
//            $file->move(public_path('/upload'), $filename);
//            $request->merge(['avatar' => $filename]);
//        }

        $create = User::create([
            'username' => $request->username,
            'password' => $request->password,
            'email' => $request->email,
            'role_id' => 3
        ]);

        // Gửi email chào mừng
        //Mail::to($create->email)->send(new WelcomeMail($create));

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
                'message' => 'login success',
                'token' => $token
            ]);
        } else {
            return response()->json([
                'message' => 'login feu',
            ]);
        }
    }

    public function logout(){
        $user = Auth::user();
        // xoa token
        $user->tokens()->delete();

        return response()->json([
            'message' => 'logout success'
        ]);
    }
}
