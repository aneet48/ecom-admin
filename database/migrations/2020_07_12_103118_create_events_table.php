<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id');
            $table->bigInteger('university_id');
            $table->string('title');
            $table->longText('description');
            $table->string('price');
            $table->date('event_date');
            $table->time('event_time');
            $table->bigInteger('order_id')->nullable();
            $table->string('contact_number');
            $table->string('book_event_link');
            $table->string('visit_website_link');
            $table->string('event_price')->default(0)->nullable(); //charged for payment
            $table->json('social_profiles')->nullable();
            $table->boolean('active')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
