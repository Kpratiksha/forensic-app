<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class User extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullname', 32);
            $table->string('email', 200)->unique();
            $table->string('password', 200);
            $table->string('confirmation_code', 30);
            $table->string('forgot_password_code', 30);
            $table->string('confirmed', 5);
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
            array(
                'fullname'              => 'Sushan Ghimire',
                'email'                 => 'ghimire.sushan@gmail.com',
                'confirmation_code'     => '2yjNrRQyQsdiA9RJiYyoacifqzZe',
                'forgot_password_code'  => '2yjNrRQyQsdiA9RJiYyoacifqzZe',
                'confirmed'             => 'true',
                'password'              => Hash::make('awesome'),
        ));
    }

    public function down()
    {
        Schema::drop('users');
    }
}
