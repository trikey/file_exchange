<?php

namespace App\Listeners;

use App\Events\UserConfirmed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use Mail;

class EmailUserInfoToUser
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
     * @param  UserConfirmed  $event
     * @return void
     */
    public function handle(UserConfirmed $event)
    {
        $user = User::find($event->user->id);
        Mail::send('emails.confirmed', ['user' => $user], function ($m) use ($user) {
            $m->from('media@redmond.company', 'media@redmond.company');
            $m->to($user->email, $user->fio)->subject(trans('users.access_granted'));
        });
    }
}
