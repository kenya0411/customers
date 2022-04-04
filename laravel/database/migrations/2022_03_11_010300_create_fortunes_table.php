<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFortunesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fortunes', function (Blueprint $table) {
            $table->integer('id');
            $table->string('orders_id')->nullable();
            $table->text('fortunes_worry')->nullable();
            $table->text('fortunes_answer')->nullable();
            $table->text('fortunes_reply1')->nullable();
            $table->text('fortunes_reply_answer1')->nullable();
            $table->text('fortunes_reply2')->nullable();
            $table->text('fortunes_reply_answer2')->nullable();
            $table->text('fortunes_reply3')->nullable();
            $table->text('fortunes_reply_answer3')->nullable();

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
        Schema::dropIfExists('fortunes');
    }
}
