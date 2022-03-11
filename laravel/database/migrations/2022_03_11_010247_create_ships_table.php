<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ships', function (Blueprint $table) {
            $table->bigIncrements('ships_id');
            $table->boolean('orders_ship_is_finished')->nullable();
            $table->integer('orders_id')->nullable();
            $table->integer('customers_id')->nullable();
            $table->string('ships_is_other_name')->nullable();
            $table->string('ships_for_name')->nullable();
            $table->text('ships_notice')->nullable();
            $table->string('ships_add_product1')->nullable();
            $table->string('ships_add_product2')->nullable();
            $table->string('ships_add_product3')->nullable();

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
        Schema::dropIfExists('ships');
    }
}
