<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dialog_id');
            $table->bigInteger('user_id');
            $table->text('message')->nullable();
            $table->string('message_type')->nullable()->default('text');
            $table->string('file')->nullable();
            $table->timestamps();
        });

        Schema::table('chat_messages', function ($table) {
            $table->foreign('dialog_id')->references('id')->on('chat_dialogs')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_messages');
    }
}
