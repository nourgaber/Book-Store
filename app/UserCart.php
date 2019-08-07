<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\UserCart as Authenticatable;

class UserCart extends Authenticatable
{
    use Notifiable;

}
