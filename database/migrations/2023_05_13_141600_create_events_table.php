<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id('event_id');
            $table->string('title');
            $table->unsignedBigInteger('genre_id');
            $table->string('image');
            $table->text('short_description');
            $table->unsignedBigInteger('amount');
            $table->date('date');
            $table->unsignedBigInteger('venue_id');
            $table->unsignedBigInteger('artist_id');
            $table->boolean('is_active');

            $table->timestamps();

            $table->foreign('genre_id')->references('genre_id')->on('genres')->constrained();
            $table->foreign('venue_id')->references('venue_id')->on('venues')->constrained();
            $table->foreign('artist_id')->references('artist_id')->on('artists')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
