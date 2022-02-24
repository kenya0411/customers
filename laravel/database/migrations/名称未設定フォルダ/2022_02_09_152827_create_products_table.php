<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->integer('products_id', true);
			$table->integer('date_year')->nullable();
			$table->integer('date_month')->nullable();
			$table->integer('products_number')->nullable();
			$table->string('products_name')->nullable();
			$table->integer('products_price')->nullable();
			$table->string('products_method')->nullable();
			$table->string('products_detail')->nullable();
			$table->integer('created_at')->nullable();
			$table->integer('updated_at')->nullable();
			$table->integer('persons_id')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('products');
	}

}
