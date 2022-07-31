<?php

namespace App\Observers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use App\Notifications\NewPostNotification;
use App\Http\Traits\BlogTrait;
use App\Notifications\PostUpdated;

class PostObserver
{
    use BlogTrait;
    /**
     * Handle the Post "created" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */

    public function creating(Post $post)
    {

        $title = Str::squish(request('title'));
        $post->title = $title;
    }
    public function created(Post $post)
    {
        //

        $admins = User::where('role', '1')->get();
        $post = Post::latest()->first();
        $this->send_notification_to_admin($admins, new NewPostNotification($post));
    }


    /**
     * Handle the Post "updated" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function updating(Post $post)
    {
        //

    }

    public function updated(Post $post)
    {
        //

        $admins = User::where('role', '1')->get();
        $post = Post::latest()->first();
        $this->send_notification_to_admin($admins, new PostUpdated($post));
    }

    /**
     * Handle the Post "deleted" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */

    public function deleting(Post $post)
    {
        //
        $post->images()->delete();
    }

    /**
     * Handle the Post "restored" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function restored(Post $post)
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function forceDeleted(Post $post)
    {
        //
    }
}
