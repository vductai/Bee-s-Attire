<?php

namespace App\Http\Controllers\auth;

use App\Events\AuthEvent;
use App\Events\LockUserAccountEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\LoginAdminRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
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




    public function toggleUserStatus($id){
        $user = User::find($id);
        $user->action = !$user->action;
        $user->update();
        broadcast(new LockUserAccountEvent($user->user_id));
        return response()->json(['message' => 'done']);
    }

    public function toggleProductStatus($id){
        $product = Product::find($id);
        $product->action = !$product->action;
        $product->update();
        return response()->json(['message' => 'done']);
    }
}
