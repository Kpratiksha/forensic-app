<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Carousel extends Migration {

	public function up() {
		Schema::create('carousel', function (Blueprint $table) {
			$table->increments('id');
			$table->string('image', 320);
			$table->string('image_alt', 320);
			$table->timestamps();
		});

		DB::table('carousel')->insert(
			array('image' => '/img/carousel/3.jpg', 'image_alt' => '1')
		);

		DB::table('carousel')->insert(
			array('image' => '/img/carousel/2.jpg', 'image_alt' => '2')
		);

		DB::table('carousel')->insert(
			array('image' => '/img/carousel/1.jpg', 'image_alt' => '3')
		);

	}

	public function down() {
		Schema::drop('carousel');
	}
}
