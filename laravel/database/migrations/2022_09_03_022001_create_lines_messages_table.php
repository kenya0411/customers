<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// class CreateProductsOptionsMultipleTable extends Migration
// class CreateLinesMessagesTable extends Migration
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lines_messages', function (Blueprint $table) {
           $table->bigIncrements('lines_messages_id');

            $table->string('lines_customers_userid')->default(0);
            $table->string('lines_messages_replytoken')->nullable(0);
            $table->text('lines_messages_text')->nullable();
            $table->string('lines_messages_from_userid')->default(0);
            $table->string('lines_messages_to_userid')->default(0);
            $table->string('lines_messages_webhook_event_id')->default(0);
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
        Schema::dropIfExists('lines_messages');
    }
};
