<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOpenedBySellerFieldToChatDialogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chat_dialogs', function (Blueprint $table) {
           $table->boolean('opened_by_seller')->nullable()->default(false);

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
            $table->dropColumn('opened_by_seller');

        });
    }
}
