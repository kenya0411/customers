<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsOptionsMultipleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_options_multiple', function (Blueprint $table) {
            $table->bigIncrements('products_options_multiple_id');
            $table->string('products_options_multiple_name')->nullable();
            $table->integer('products_options_multiple_price')->nullable();
            $table->text('products_options_multiple_detail')->nullable();
            $table->integer('products_id')->nullable();
            $table->string('products_options_name')->nullable();
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
        Schema::dropIfExists('products_options_multiple');
    }
}
