<?php

namespace App\Http\Controllers\api\client;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function updateProfile(UserRequest $request)
    {
        try {
            $this->authorize('update', Auth::user());
        } catch (AuthorizationException $e) {
            // handle unauthorized access
        }

        if (Auth::check()) {
            $userId = Auth::user()->user_id;

            // Lấy avatar hiện tại nếu không có file mới được upload
            $user = User::find($userId);
            $imageName = $user->avatar;

            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $imageName = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('/upload'), $imageName);
                $request->merge(['avatar' => $imageName]);
            }

            $user->update([
                'avatar' => $imageName,
                'username' => $request->username,
                'gender' => $request->gender,
                'phone' => $request->phone,
                'birthday' => $request->birthday,
                'address' => $request->address,
            ]);

            $update = User::find($userId);


            return response()->json([
                'message' => 'update profile',
                'data' => $update
            ]);
        }
    }



}
