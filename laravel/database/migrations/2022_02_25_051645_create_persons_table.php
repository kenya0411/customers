<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->bigIncrements('persons_id');
            $table->string('persons_name')->nullable();
            $table->string('persons_platform_name')->nullable();
            $table->text('persons_platform_url')->nullable();
            $table->integer('persons_platform_fee')->nullable();
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
        Schema::dropIfExists('persons');
    }
}
