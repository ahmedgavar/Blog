<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class NotificationList extends Component
{
    public $notifications,$new_notification;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($count=5)
    {
        //
        $current_user=Auth::user();
        if($current_user->role=='1')
        {
            $this->notifications=$current_user->notifications()->take($count)->get();
            $this->new_notification=$current_user->unreadNotifications()->count();
        }




    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.notification-list');
    }
}
