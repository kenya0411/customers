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
            $table->bigIncrements('customers_id');
            $table->string('customers_nickname')->nullable();
            $table->string('customers_name')->nullable();
            $table->text('customers_address')->nullable();
            $table->text('customers_note')->nullable();
            $table->string('customers_age')->nullable();
            $table->string('customers_prefecture')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
