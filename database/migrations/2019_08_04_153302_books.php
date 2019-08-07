<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Books extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('book_name');
            $table->float('book_renting_price');
            $table->float('book_price');
            $table->integer('author_id');
            $table->timestamps();
            $table->softDeletes();
            
        });
        Schema::table('books', function (Blueprint $table) {
         
            $table->foreign('author_id')->references('id')->on('Author');
        });
     
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
