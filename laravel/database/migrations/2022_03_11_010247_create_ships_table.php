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
            $table->unique(['id']);
            $table->integer('id');
            $table->integer('orders_is_ship_finished')->default(0);
            $table->integer('orders_is_ship_shipped')->default(0);
            $table->string('ships_is_other_name')->nullable();
            $table->text('ships_notice')->nullable();
            $table->string('ships_add_product1')->nullable();
            $table->string('ships_add_product2')->nullable();
            $table->string('ships_add_product3')->nullable();
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
        Schema::dropIfExists('ships');
    }
}
