<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(){
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }

        $list = Post::orderBy('created_at', 'desc')->get();
        return view('admin.post.list-post', compact('list'));
    }

    public function create()
    {
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        return view('admin.post.create-post');
    }
    public function store(Request $request){
        try {
            $this->authorize('manageAdmin', Auth::user());
        } catch (AuthorizationException $e) {
        }
        if ($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $filename = time() . '.' .$file->getClientOriginalExtension();
            $file->move(public_path('upload/'), $filename);
            $request->merge(['avatar' => $filename]);
        }
        Post::create([
            'avatar' => $filename,
            'title' => $request->title,
            'desc' => $request->desc,
            'slug' => $request->slug,
            'content' => $request['content']
        ]);
        return back();
    }

    public function togglePostStatus($id){
        $post = Post::find($id);
        $post->action = !$post->action;
        $post->update();
        return redirect()->back();
    }
}
