<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\client\forgotPasswordRequest;
use App\Jobs\DeleteExpiredResetTokenJob;
use App\Jobs\SendResetPasswordEmailJob;
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
        $request->validate([
            'email' => 'required|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'
        ],[
            'email.required' => 'Vui lòng nhập',
            'email.regex' => 'Email không đúng định dạng'
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Email này không tồn tại.'
            ]);
        }
        // tạo token
        $checkToken = DB::table('password_reset_tokens')->where('email', $request->email)->exists();
        if ($checkToken){
            return response()->json([
                'success' => false,
                'message' => 'Bạn đã gửi yêu cầu đặt lại mật khẩu, vui lòng xác thực .'
            ]);
        }else{
            $token = Str::random(60);
            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => now(),
            ]);
        }
        // xóa mã sau 5p ko xác minh
        DeleteExpiredResetTokenJob::dispatch()->delay(now()->addMinutes(5));
        // Gửi email xác minh
        SendResetPasswordEmailJob::dispatch($request->email, $token, $user);
        return response()->json(['message' => 'done']);
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
            return response()->json([
                'success' => false,
                'message' => 'Token không hợp lệ.'
            ]);
        }
        // Kiểm tra email khớp với token
        if ($passwordReset->email !== $request->email) {
            return response()->json([
                'success' => false,
                'message' => 'Email không hợp lệ.'
            ]);
        }
        // Đặt lại mật khẩu
        $user = User::where('email', $request->email)->first();
        $user->password = $request->password;
        $user->save();
        // Xóa token sau khi đặt lại mật khẩu thành công
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        return response()->json(['message' => 'done']);
    }
}
