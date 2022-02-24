<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsOptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products_options', function(Blueprint $table)
		{
			$table->integer('products_options_id', true);
			$table->integer('products_number')->nullable();
			$table->integer('persons_id')->nullable();
			$table->integer('products_options_number')->nullable();
			$table->string('products_options_name')->nullable();
			$table->integer('products_options_price')->nullable();
			$table->string('products_options_detail')->nullable();
			$table->integer('date_year')->nullable();
			$table->integer('date_month')->nullable();
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
		Schema::drop('products_options');
	}

}
