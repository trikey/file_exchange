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
        $admin_emails = [];
        foreach($admins as $admin)
        {
            $admin_emails[] = ['email' => $admin->email, 'fio' => $admin->fio];
        }
        $user = $event->user;
        if (!empty($admin_emails))
        {
            Mail::send('emails.registered', ['user' => $user], function ($m) use ($admin_emails) {
                $m->from('media@redmond.company', 'media@redmond.company');
                foreach($admin_emails as $admin_email)
                {
                    $m->to($admin_email->email, $admin_email->fio);
                }
                $m->subject(trans('users.new_user_registered'));
            });
        }
    }
}
