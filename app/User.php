<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'file_name'
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany('App\Image');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function unlikes()
    {
        return $this->hasMany('App\Unlike');
    }

    public function recievedLikes()
    {
        return $this->hasManyThrough('App\Like', 'App\Image');
    }
}
