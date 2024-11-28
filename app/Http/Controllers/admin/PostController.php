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
        $request->validate(
            [
                'title' => ['required'],
                'slug' => ['required'],
                'desc' => ['required'],
                'content' => ['required'],
                'avatar' => ['required']
            ],
            [
                'title.required' => 'Vui lòng nhập',
                'slug.required' => 'Vui lòng nhập',
                'desc.required' => 'Vui lòng nhập',
                'content.required' => 'Vui lòng nhập',
                'avatar.required' => 'Vui lòng chọn ảnh'
            ]
        );

        if ($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $filename = time() . '.' .$file->getClientOriginalExtension();
            $file->move(public_path('upload/'), $filename);
            $request->merge(['avatar' => $filename]);
        }
        $post = Post::create([
            'avatar' => $filename,
            'title' => $request->title,
            'desc' => $request->desc,
            'slug' => $request->slug,
            'content' => $request['content']
        ]);
        return response()->json($post);
    }

    public function edit($id){
        $post = Post::findOrFail($id);
        return view('admin.post.edit-post',compact('post'));
    }

    public function update(Request $request, $id){
        $post = Post::findOrFail($id);
        $request->validate(
            [
                'title' => ['required'],
                'slug' => ['required'],
                'desc' => ['required'],
                'content' => ['required'],
                'avatar' => ['required']
            ],
            [
                'title.required' => 'Vui lòng nhập',
                'slug.required' => 'Vui lòng nhập',
                'desc.required' => 'Vui lòng nhập',
                'content.required' => 'Vui lòng nhập',
                'avatar.required' => 'Vui lòng chọn ảnh'
            ]
        );

        if ($request->hasFile('avatar')){
            $file = $request->file('avatar');
            $filename = time() . '.' .$file->getClientOriginalExtension();
            $file->move(public_path('upload/'), $filename);
            $request->merge(['avatar' => $filename]);
        }
        $post->update([
            'avatar' => $filename,
            'title' => $request->title,
            'desc' => $request->desc,
            'slug' => $request->slug,
            'content' => $request['content']
        ]);

        return response()->json($post);
    }

    public function destroy($id){
        $post = Post::findOrFail($id);
        $post->delete();
        return response()->json(['message' => 'done']);
    }

    public function togglePostStatus($id){
        $post = Post::find($id);
        $post->action = !$post->action;
        $post->update();
        return redirect()->back();
    }
}
