<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class BlockHashTable extends Migration {
	public function up() {
		Schema::create('block_hash', function (Blueprint $table) {
			$table->increments('id');
			$table->string('block_hash', 64);
			$table->string('flag', 1);
			$table->string('metadata', 500);
			$table->timestamps();
		});

		DB::table('block_hash')->insert(
			array(
				'block_hash' => '0000000000000000000a8eea6fec94fbc227334f50ed92611bdafcfead4b6493',
				'flag' => '1',
				'metadata' => 'This block has numerous transactions that have been involved in illicit activities.',
			));

		DB::table('block_hash')->insert(
			array(
				'block_hash' => '0000000000000000000a8eea6fec94fbc227334f50ed92611bdafcfead4b6493',
				'flag' => '1',
				'metadata' => 'From wallet 4dca01ca5fc56392e7eda587f1074',
			));

	}

	public function down() {
		Schema::drop('block_hash');
	}
}
