<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function comment(CommentRequest $request){
        if (Auth::check()){
            $user_id = Auth::user()->user_id;
            $comment = Comment::create([
                'user_id' => $user_id,
                'product_id' => $request->product_id,
                'comment' => $request->comment
            ]);

            return response()->json([
                'message' => 'add comment',
                'data' => $comment
            ]);
        }


    }
}
