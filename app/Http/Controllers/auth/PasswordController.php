<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\client\forgotPasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('client.auth.forgotPassword');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email này không tồn tại.']);
        }

        $token = Str::random(60);


        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
        ]);

        // Gửi email xác minh
        Mail::send('mail.Reset-password', ['token' => $token, 'user' => $user], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Yêu cầu đặt lại mật khẩu');
        });

        return view('client.auth.message.password.reset-email');
    }

    // Hiển thị form nhập mật khẩu mới
    public function showResetForm($token)
    {
        return view('client.auth.reset-password', ['token' => $token]);
    }

    // Xử lý đặt lại mật khẩu
    public function resetPassword(forgotPasswordRequest $request)
    {

        // Kiểm tra token trong bảng password_resets
        $passwordReset = DB::table('password_reset_tokens')
            ->where('token', $request->token)
            ->first();

        if (!$passwordReset) {
            return back()->withErrors(['token' => 'Token không hợp lệ.']);
        }

        // Kiểm tra email khớp với token
        if ($passwordReset->email !== $request->email) {
            return back()->withErrors(['email' => 'Email không hợp lệ.']);
        }

        // Đặt lại mật khẩu
        $user = User::where('email', $request->email)->first();
        $user->password = $request->password;
        $user->save();

        // Xóa token sau khi đặt lại mật khẩu thành công
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return view('client.auth.message.password.reset-email-success');
    }
}
