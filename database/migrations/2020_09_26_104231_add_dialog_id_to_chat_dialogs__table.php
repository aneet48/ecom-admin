<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDialogIdToChatDialogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chat_dialogs', function (Blueprint $table) {
           $table->string('connecty_dialog_id')->nullable();
           $table->string('xmpp_room_jid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chat_dialogs', function (Blueprint $table) {
           $table->dropColumn('connecty_dialog_id');
           $table->dropColumn('xmpp_room_jid');

        });
    }
}
