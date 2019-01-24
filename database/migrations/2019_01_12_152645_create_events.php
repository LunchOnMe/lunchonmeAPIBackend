<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('image')->nullable();
            $table->text('description');
            $table->integer('attendance_limit')->default(100000);
            $table->string('organizers')->nullable();
            $table->string('organizer_link')->nullable();
            $table->dateTimeTz('date');
            $table->json('location');
            $table->string('helpline')->nullable();
            $table->boolean('active')->default(true);
            $table->boolean('donations_enabled')->default(false);
            $table->integer('donation_limit')->default(0);
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
