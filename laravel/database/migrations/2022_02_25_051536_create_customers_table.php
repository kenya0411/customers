<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            // $table->bigIncrements('id');
            // $table->timestamps();
            $table->integer('id', true);
            $table->string('customers_product_id')->nullable();
            $table->string('customers_id')->nullable();
            $table->string('customers_nickname')->nullable();
            $table->string('customers_name')->nullable();
            $table->integer('date_year')->nullable();
            $table->integer('date_month')->nullable();
            $table->integer('date_day')->nullable();
            $table->integer('persons_id')->nullable();
            $table->integer('products_id')->nullable();
            $table->integer('products_options_id')->nullable();
            $table->integer('customers_etc_price')->nullable();
            $table->text('customers_address')->nullable();
            $table->text('customers_note')->nullable();
            $table->string('customers_age')->nullable();
            $table->string('customers_prefecture')->nullable();
            $table->text('customers_worry')->nullable();
            $table->text('customers_answer')->nullable();
            $table->text('customers_reply1')->nullable();
            $table->text('customers_reply_answer1')->nullable();
            $table->text('customers_reply2')->nullable();
            $table->text('customers_reply_answer2')->nullable();
            $table->text('customers_reply3')->nullable();
            $table->text('customers_reply_answer3')->nullable();
            $table->text('customers_deliver_notice')->nullable();
            $table->string('customers_deliver_add_product')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
