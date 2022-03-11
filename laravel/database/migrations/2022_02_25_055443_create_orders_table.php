<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
           $table->bigIncrements('id');
            $table->integer('orders_id')->nullable();
            $table->integer('customers_id')->nullable();
            $table->integer('products_id')->nullable();
            $table->integer('products_options_id')->nullable();
            $table->integer('products_options_multiple_id')->nullable();
            $table->integer('persons_id')->nullable();
            $table->integer('users_id')->nullable();
            $table->integer('fortunes_id')->nullable();
            $table->integer('orders_price')->nullable();
            $table->boolean('orders_is_reserve_finished')->nullable();
            $table->boolean('orders_is_ship_finished')->nullable();
            $table->timestamps('created_at')->nullable();
            $table->timestamps('updated_at')->nullable();
            $table->boolean('is_delete');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
