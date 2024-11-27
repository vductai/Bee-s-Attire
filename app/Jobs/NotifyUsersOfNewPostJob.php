<?php

namespace App\Jobs;

use App\Events\NotiPostEvent;
use App\Models\Notifications;
use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NotifyUsersOfNewPostJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $post;

    /**
     * @param $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }


    public function handle()
    {
        $user = User::all();
        foreach ($user as $u){
            $notiPost = Notifications::create([
                'user_id' => $u->user_id,
                'message' => 'Có một bài viết mới'
            ]);
            // chỉ phát sự kiện cho user hiện tại
            broadcast(new NotiPostEvent($notiPost->load('user')));
        }
    }
}
