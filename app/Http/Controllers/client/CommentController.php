<?php
namespace App\Http\Controllers\client;

use App\Events\CommentEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{

    public function comment(CommentRequest $request){
        if (Auth::check()){
            $user = Auth::user();
            $comment = Comment::create([
                'user_id' => $user->user_id,
                'product_id' => $request->product_id,
                'comment' => $request->comment
            ]);
            broadcast(new CommentEvent($comment))->toOthers();
            return response()->json([
                'comment' => $comment->comment,
                'user' => [
                    'username' => $user->username,
                    'avatar' => $user->avatar
                ],
                'product_id' => $comment->product_id,
                'created_at' => $comment->created_at
            ]);
        }
    }
}
