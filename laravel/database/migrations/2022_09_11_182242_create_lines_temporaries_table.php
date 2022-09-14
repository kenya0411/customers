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
        Schema::create('lines_temporaries', function (Blueprint $table) {
            $table->bigIncrements('lines_temporaries_id');
           $table->string('lines_messages_id')->nullable();
            $table->string('lines_customers_userid')->default(0);
            $table->text('lines_messages_text')->nullable();
            $table->integer('users_id')->default(0);
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
        Schema::dropIfExists('lines_temporaries');
    }
};
