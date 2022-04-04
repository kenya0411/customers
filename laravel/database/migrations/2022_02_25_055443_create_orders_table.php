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
            $table->string('orders_id')->default(0);
            $table->integer('customers_id')->default(0);
            $table->integer('products_id')->default(0);
            $table->integer('products_options_id')->default(0);
            $table->integer('products_options_multiple_id')->default(0);
            $table->integer('persons_id')->default(0);
            $table->integer('users_id')->default(0);
            $table->integer('orders_price')->default(0);
            $table->integer('orders_is_reserve_finished')->default(0);
            $table->integer('orders_is_ship_finished')->default(0);
            $table->text('orders_notice')->nullable();

            $table->timestamp('updated_at')->useCurrent()->nullable();
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->boolean('is_delete')->default(0);



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
