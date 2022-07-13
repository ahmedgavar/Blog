<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\NewPostNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class SendNewUserNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
        $admins = User::where('role','1')->get();

    Notification::send($admins, new NewPostNotification($event->post));
    }
}   
