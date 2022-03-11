<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('products_id');
            $table->string('products_name')->nullable();
            $table->integer('products_price')->nullable();
            $table->string('products_method')->nullable();
            $table->text('products_detail')->nullable();
            $table->integer('persons_id')->nullable();
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
        Schema::dropIfExists('products');
    }
}
