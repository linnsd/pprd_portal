<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Models\Activity;

class LoginSuccessful
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
    public function handle(Login $event)
    {
        $event->subject = 'login';
        $event->descritpion = $event->user->name.'  login to system.';

        Session::flash("login-success",'Hello'.$event->user->name.', welcome back.');
        activity($event->subject)
                ->by($event->user)
                ->log($event->descritpion);
    }
}
