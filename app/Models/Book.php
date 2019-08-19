<?php

namespace App\Models;
use App\Models\Author;
use App\Models\User;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'book_name', 'book_renting_price', 'book_price','author_id',
    ];
    public function Authors()
    {
      return $this->belongsToMany(Author::class);
    }
    public function users()
    {
      return $this->belongsToMany(User::class);
    }
}
