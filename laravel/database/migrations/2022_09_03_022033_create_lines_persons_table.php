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
        Schema::create('lines_persons', function (Blueprint $table) {
            // $table->id();
            // $table->timestamps();
           $table->bigIncrements('lines_persons_id');

            $table->integer('persons_id')->default(0);
            $table->string('lines_persons_userid')->default(0);
            $table->string('lines_persons_channel_id')->default(0);
            $table->string('lines_persons_channel_secret')->default(0);
            $table->string('lines_persons_access_token')->default(0);
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
        Schema::dropIfExists('lines_persons');
    }
};
