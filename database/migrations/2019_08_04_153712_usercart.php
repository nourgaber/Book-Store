<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class usercart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usercart', function (Blueprint $table) {

            $table->Integer('user_id');
            $table->Integer('book_id');
       $table->foreign('user_id')->references('id')->on('users');
       $table->foreign('book_id')->references('id')->on('Books');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
