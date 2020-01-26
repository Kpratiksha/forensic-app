<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class WalletTable extends Migration {
	public function up() {
		Schema::create('wallet', function (Blueprint $table) {
			$table->increments('id');
			$table->string('address', 64);
			$table->string('flag', 1);
			$table->string('metadata', 500);
			$table->timestamps();
		});

		DB::table('wallet')->insert(
			array(
				'address' => 'bc1qvlukzn0w8cs7myyv5lczqaer0vywahsqe5taqd',
				'flag' => '1',
				'metadata' => 'This wallet address has sent transactions that may have been involved in illicit activities.',
			));
	}

	public function down() {
		Schema::drop('wallet');
	}
}
