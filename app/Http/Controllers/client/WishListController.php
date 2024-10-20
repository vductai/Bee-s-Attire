<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;

class WishListController extends Controller
{
    public function index()
    {
        return view('client.wish-list');
    }
}
