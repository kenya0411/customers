<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('persons', function(Blueprint $table)
		{
			$table->integer('persons_id', true);
			$table->string('persons_name')->nullable();
			$table->string('persons_platform_name')->nullable();
			$table->string('persons_platform_url')->nullable();
			$table->integer('persons_platform_fee')->nullable();
			$table->integer('created_at')->nullable();
			$table->integer('updated_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('persons');
	}

}
