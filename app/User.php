<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'email', 'password', 'handle'
    ];

    protected $attributes = [
        'about' => 'Hey there! I am using SimpleChat',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function conversations()
    {
        return $this->hasMany('App\Conversation', 'owner_id');
    }
    public function orders()
    {
        return $this->hasMany('App\Order', 'sender_id');
    }
    public function notifications()
    {
        return $this->hasMany('App\Request', 'receiver_id');
    }
}
