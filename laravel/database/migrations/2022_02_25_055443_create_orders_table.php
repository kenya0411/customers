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
            
            $table->integer('id', true);
            $table->string('orders_id')->nullable();
            $table->integer('customers_id')->nullable();
            $table->string('products_id')->nullable();
            $table->string('product_options_id')->nullable();
            $table->integer('users_id')->nullable();
            $table->integer('orders_price')->nullable();
            $table->integer('orders_etc_price')->nullable();
            $table->text('orders_worry')->nullable();
            $table->text('orders_answer')->nullable();
            $table->text('orders_reply1')->nullable();
            $table->text('orders_reply_answer1')->nullable();
            $table->text('orders_reply2')->nullable();
            $table->text('orders_reply_answer2')->nullable();
            $table->text('orders_reply3')->nullable();
            $table->text('orders_reply_answer3')->nullable();
            $table->text('orders_deliver_notice')->nullable();
            $table->string('orders_deliver_add_product')->nullable();
            $table->timestamps('created_at')->nullable();
            $table->timestamps('updated_at')->nullable();
            $table->string('customers_fortune_is_finished')->nullable();
            $table->string('customers_ship_is_finished')->nullable();
            $table->integer('users_id')->nullable();
            $table->string('product_name')->nullable();
            $table->string('products_options_name')->nullable();
            $table->string('persons_name')->nullable();
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
