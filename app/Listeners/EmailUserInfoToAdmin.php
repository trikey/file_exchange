<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use Mail;

class EmailUserInfoToAdmin
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
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        $admins = User::where('isAdmin', 1)->get();
        foreach($admins as $admin)
        {
            $user = $event->user;
            Mail::send('emails.registered', ['user' => $user], function ($m) use ($admin) {
                $m->from('info@media.redmond.company', 'info@media.redmond.company');
                $m->to($admin->email, $admin->fio)->subject(trans('users.new_user_registered'));
            });
        }
    }
}
