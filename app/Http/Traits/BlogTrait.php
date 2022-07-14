<?php

namespace App\Http\Traits;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;


trait BlogTrait
{
    public function send_notification_to_admin($receiver, $notification_class)
    {
        Notification::send($receiver, $notification_class);
    }
}
