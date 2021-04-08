<?php

namespace App\Listeners\Accountcreation;

use App\Events\AccountCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\WelcomeMail;

class WelcomeMailNotification implements ShouldQueue
{
    public $delay = 120;
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
     * @param  AccountCreated  $event
     * @return void
     */
    public function handle(AccountCreated $event)
    {
        print('sending welcome mail');
        \Mail::to($event->user->email)->send(new WelcomeMail($event->user));
    }
}
