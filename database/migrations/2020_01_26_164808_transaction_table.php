<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class TransactionTable extends Migration {
	public function up() {
		Schema::create('transaction', function (Blueprint $table) {
			$table->increments('id');
			$table->string('tx_id', 64);
			$table->string('flag', 1);
			$table->string('metadata', 500);
			$table->timestamps();
		});

		DB::table('transaction')->insert(
			array(
				'tx_id' => '01ce7fef7465ab8dadcd297a11c4dca01ca5fc56392e7eda587f10745e0ff040',
				'flag' => '1',
				'metadata' => 'This transaction has inputs from wallets that have involved in illicit activities.',
			));
	}

	public function down() {
		Schema::drop('transaction');
	}
}