<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\request\UserRequest;
use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{

    public function index()
    {

        $this->authorize('viewAny', User::class);
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


    public function login(UserRequest $request){

        // chi lay email va password
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


    public function ForgotPassword(Request $request){

        $response = Password::sendResetLink($request->only('email'));

        return $response == Password::RESET_LINK_SENT
            ? response()->json(['status' => __($response)])
            : response()->json(['email' => __($response)], 422);
    }


    public function reset(Request $request){
        $response = Password::reset($request->only('email', 'password', 'token'), function ($user, $password) {
            $user->password = bcrypt($password);
            $user->save();
        });

        return $response == Password::PASSWORD_RESET
            ? response()->json(['status' => __($response)])
            : response()->json(['email' => __($response)], 422);
    }

}
