<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Events\PostComment;
use Redirect;

class CommentController extends Controller
{
    public function store(CommentRequest $request)
    {
        $data = [
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'comment' => $request->comment
        ];

        $comment = Comment::create($data);
        // Log để xác nhận
        \Log::info('Broadcasting comment', ['comment' => $comment->toArray()]);


        broadcast(new PostComment($comment));

        return Redirect()->back()->with([
            'comment' => $comment
        ]);

    }

    // public function comment(CommentRequest $request){
    //     if (Auth::check()){
    //         $user_id = Auth::user()->user_id;
    //         $comment = Comment::create([
    //             'user_id' => $user_id,
    //             'product_id' => $request->product_id,
    //             'comment' => $request->comment
    //         ]);

    //         return response()->json([
    //             'message' => 'add comment',
    //             'data' => $comment
    //         ]);
    //     }

    // }
}
