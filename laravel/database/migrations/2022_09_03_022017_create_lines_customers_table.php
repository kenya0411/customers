<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lines_customers', function (Blueprint $table) {
           $table->bigIncrements('lines_customers_id');

            $table->string('lines_customers_userid')->default(0);
            $table->string('lines_customers_name')->default(0);
            $table->integer('customers_id')->default(0);
            $table->integer('persons_id')->default(0);
            $table->string('lines_customers_display_name')->default(0);
            $table->text('lines_customers_picture_url')->nullable();
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
        Schema::dropIfExists('lines_customers');
    }
};
