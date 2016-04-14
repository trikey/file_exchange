<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fio');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('organisation');
            $table->integer('isAdmin')->unsigned()->nullable()->default(0);
            $table->integer('isModerator')->unsigned()->nullable()->default(0);
            $table->integer('canAccess')->unsigned()->nullable()->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
