<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Policy;

class PolicyClientController extends Controller
{
    public function policy()
    {
        $firstPolicies = Policy::orderBy('id', 'asc')->limit(4)->get();

        $lastPolicies = Policy::orderBy('id', 'desc')->limit(4)->get();
        return view('client.us.policy', compact('firstPolicies', 'lastPolicies'));
    }
}
