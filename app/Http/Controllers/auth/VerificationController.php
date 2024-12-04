<?php

namespace App\Http\Controllers\auth;

use App\Events\GiveVoucherEvent;
use App\Http\Controllers\Controller;
use App\Jobs\GiveVoucherJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class VerificationController extends Controller
{
    public function verify(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);
        if (!hash_equals((string) $hash, sha1($user->email))) {
            return redirect('/auth/error-outtime');
        }
        if ($user->hasVerifiedEmail()) {
            return redirect('/auth/error');
        }
        $user->markEmailAsVerified();
        Auth::login($user);
        GiveVoucherJob::dispatch($user->user_id)->delay(now()->addMinutes(1));
        return redirect()->route('home');
    }
}
