<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fio', 'email', 'password', 'organisation', 'isModerator', 'isAdmin', 'canAccess'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeFindByEmail($query, $email)
    {
        return $query->where('email', '=', $email);
    }

    public function scopeFindUsers($query)
    {
        return $query->where('isAdmin', '!=', 1)->where('isModerator', '!=', 1);
    }


    public function scopeFindUsersByName($query, $name)
    {
        return $query
            ->where('fio', 'like', '%'.$name.'%')
            ->orWhere('email', 'like', '%'.$name.'%')
            ->orWhere('organisation', 'like', '%'.$name.'%');
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function setPasswordConfirmationAttribute($password)
    {
        $this->attributes['password_confirmation'] = bcrypt($password);
    }
}
