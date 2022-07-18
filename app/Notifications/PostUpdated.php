<?php

namespace App\Notifications;

use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;

class PostUpdated extends Notification
{
    use Queueable;
    protected $post;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        //
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }



    public function toDatabase($notifiable)
    {
        $body = sprintf(
            '%s updated the post ',
            auth()->user()->name,


        );
        $current_time = Carbon::now()->toDateTimeString();

        return [
            'title' => ' Post was updated ',
            'body' => $body,
            'current_time' => $current_time,
            'icon' => "fas fa-bell",
            'url' => route('users.posts.show', $this->post->id)

        ];
    }

    public function toBroadcast($notifiable)
    {
        $date = $this->post->created_at; // now date is a carbon instance


        $body = sprintf(
            '%s added new post about %s',
            $this->post->user->name,
            $this->post->title

        );
        return new BroadcastMessage([
            'title' => 'New Post Added',
            'body' => $body,
            'icon' => "fas fa-bell",
            'url' => route('users.posts.show', $this->post->id),
            'current_time' => $date,

        ]);
    }
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
