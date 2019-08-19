<?php

namespace App\Models;
use App\Models\Book;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\Author as Authenticatable;

class Author extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
    ];

    public function books()
    {
      return $this->belongsToMany(Book::class);
    }
}
