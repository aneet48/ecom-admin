<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConnectyCubesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connecty_cubes', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('password');
            $table->string('connectycube_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });

        Schema::table('connecty_cubes', function ($table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('connecty_cubes');
    }
}
