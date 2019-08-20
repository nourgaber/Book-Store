<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Book;
use App\Models\Role;
use App\Events\UserEvent;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'email', 'password','active', 'activation_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * 
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','activation_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $dispatchesEvents = [
      'saving' => \App\Events\UserEvent::class,
  ];

    public function roles()
{
  return $this->belongsToMany(Role::class);
}

public function Books()
{
  return $this->belongsToMany(Book::class);
}
}
