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
            $table->id(); // Primary key
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('titel'); // Required
            $table->string('locatie_naam'); // Required
            $table->date('datum'); // Required
            $table->time('tijd'); // Required
            $table->text('beschrijving')->nullable(); // Required
            $table->string('foto_pad')->nullable(); // File upload (optional)
            $table->string('locatie_url')->nullable(); // Optional URL field
            $table->integer('zoom')->default(100); // Optional, default to 100
            $table->integer('horizontaal')->default(50); // Optional, default to 50
            $table->integer('verticaal')->default(50); // Optional, default to 50
            $table->boolean('publiek')->default(false); // Optional checkbox, defaults to false
            $table->string('evenement_url')->nullable();
            $table->timestamps(); // Created at, updated at
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
