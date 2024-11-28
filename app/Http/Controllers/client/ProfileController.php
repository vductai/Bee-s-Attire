<?php

namespace App\Http\Controllers\client;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{

    public function getProfile()
    {
        $user = Auth::user();
        $vouchers = $user->voucher;
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

    public function updatePass(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ], [
            'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại.',
            'new_password.required' => 'Vui lòng nhập mật khẩu mới.',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự.',
            'confirm_password.required' => 'Vui lòng xác nhận mật khẩu mới.',
            'confirm_password.same' => 'Xác nhận mật khẩu không khớp với mật khẩu mới.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // Kiểm tra mật khẩu hiện tại

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return response()->json(['errors' => ['current_password' => ['Mật khẩu hiện tại không đúng.']]], 422);
        }

        // Cập nhật mật khẩu
        $user = User::query()->find(Auth::user()->user_id);
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => 'Đổi mật khẩu thành công.']);
    }
}
