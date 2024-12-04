<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\user_voucher;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{

    public function getProfile()
    {
        $user = Auth::user();
        $vouchers = user_voucher::where('user_id', $user->user_id)->get();
        return view('client.Profile-client', compact('vouchers'));
    }


    public function updateProfile(Request $request)
    {
        Log::info($request->all());
        try {
            $this->authorize('manageClient', Auth::user());
        } catch (AuthorizationException $e) {
            // handle unauthorized access
        }

        if (Auth::check()) {
            $userId = Auth::user()->user_id;
            $user = User::findOrFail($userId);
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
            return redirect()->route('profile');
        }
    }

    public function changePasswordProfile(Request $request){
        $id = Auth::user()->user_id;
        $change = User::findOrFail($id);
        $request->validate(
            [
                'changePassword' => ['required'],
                'confirmPassword' => ['required', 'same:changePassword']
            ],
            [
                'changePassword.required' => 'Không được để trống',
                'confirmPassword.required' => 'Không được để trống',
                'confirmPassword.same' => 'Không khớp với mật khẩu trước'
            ]
        );
        $change->update([
            'password' => $request->changePassword
        ]);
        return response()->json(['message' => 'done']);
    }

}
