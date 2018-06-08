<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogs extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('logs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->smallInteger('changer_id')->unsigned();
			$table->foreign('changer_id')->references('id')->on('users');
			$table->smallInteger('action_id')->unsigned();
			$table->foreign('action_id')->references('id')->on('action_logs');
			$table->smallInteger('target_id')->unsigned()->default(0);
			$table->foreign('target_id')->references('id')->on('users');
			$table->string('old_value')->nullable()->default(null);
			$table->string('new_value')->nullable()->default(null);
			$table->string('ip', 15);
			$table->string('user_agent');
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
		Schema::drop('logs');
	}

}
