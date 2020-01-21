<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Gallery extends Migration {

	public function up() {
		Schema::create('gallery', function (Blueprint $table) {
			$table->increments('id');
			$table->string('image', 320);
			$table->string('image_alt', 320);
			$table->timestamps();
		});

		DB::table('gallery')->insert(array('image' => '/img/gallery/gal-1.jpg', 'image_alt' => ''));
		DB::table('gallery')->insert(array('image' => '/img/gallery/gal-2.jpg', 'image_alt' => ''));
		DB::table('gallery')->insert(array('image' => '/img/gallery/gal-3.jpg', 'image_alt' => ''));
		DB::table('gallery')->insert(array('image' => '/img/gallery/gal-4.jpg', 'image_alt' => ''));

		DB::table('gallery')->insert(array('image' => '/img/gallery/gal-11.jpg', 'image_alt' => ''));
		DB::table('gallery')->insert(array('image' => '/img/gallery/gal-12.jpg', 'image_alt' => ''));
		DB::table('gallery')->insert(array('image' => '/img/gallery/gal-13.jpg', 'image_alt' => ''));
		DB::table('gallery')->insert(array('image' => '/img/gallery/gal-14.jpg', 'image_alt' => ''));

		DB::table('gallery')->insert(array('image' => '/img/gallery/gal-21.jpg', 'image_alt' => ''));
		DB::table('gallery')->insert(array('image' => '/img/gallery/gal-22.jpg', 'image_alt' => ''));
		DB::table('gallery')->insert(array('image' => '/img/gallery/gal-23.jpg', 'image_alt' => ''));
		DB::table('gallery')->insert(array('image' => '/img/gallery/gal-24.jpg', 'image_alt' => ''));

		DB::table('gallery')->insert(array('image' => '/img/gallery/gal-31.jpg', 'image_alt' => ''));
		DB::table('gallery')->insert(array('image' => '/img/gallery/gal-32.jpg', 'image_alt' => ''));
		DB::table('gallery')->insert(array('image' => '/img/gallery/gal-33.jpg', 'image_alt' => ''));
		DB::table('gallery')->insert(array('image' => '/img/gallery/gal-34.jpg', 'image_alt' => ''));

	}

	public function down() {
		Schema::drop('gallery');
	}
}
