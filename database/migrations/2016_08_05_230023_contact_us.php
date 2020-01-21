<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContactUs extends Migration
{
    public function up()
    {
        Schema::create('contact_us', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullname', 64);
            $table->string('email', 320);
            $table->string('phone', 64);
            $table->text('message', 640);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('contact_us');
    }
}
