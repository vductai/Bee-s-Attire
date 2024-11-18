<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $list = Post::orderBy('created_at', 'desc')->paginate(4);
        return view('client.posts.list-post', compact('list'));
    }

    public function show($slug){
        $detail = Post::where('slug', $slug)->first();
        return view('client.posts.detail-post', compact('detail'));
    }
}
