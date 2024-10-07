<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class VerificationController extends Controller
{
    public function verify(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        if (!hash_equals((string) $hash, sha1($user->email))) {
            return redirect('')->with('error', 'Thời gian xác minh đã hết hạn');
        }

        if ($user->hasVerifiedEmail()) {
            return redirect('/auth/error')->with('status', 'Tài khoản này đã được xác minh');
        }

        $user->markEmailAsVerified();

        return redirect()->route('success');
    }
}
