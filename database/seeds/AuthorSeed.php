<?php

use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    $Author_one = new Author();
    $Author_one->name = 'nour';
    $Author_one->save();
    $Author_two = new Author();
    $Author_two->name = 'ahmed';
    $Author_two->save();
    }
}
