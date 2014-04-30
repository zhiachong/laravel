<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table)
		{
			$table->increments('id');
			$table->integer('role');

			$table->text('email');
			$table->text('username');
			$table->text('password');
			$table->text('passwrod_temp');
			$table->text('code');
			$table->integer('active');

			$table->text('solidtrustpay_acc');
			$table->text('perfectmoney_acc');
			$table->text('egopay_acc');
			$table->text('payeer_acc');
			$table->text('bitcoin_acc');

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