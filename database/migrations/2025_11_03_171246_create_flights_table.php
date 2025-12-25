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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('airplane_id')->constrained('airplanes')->onDelete('cascade');
            $table->foreignId('departure_gate')->constrained('gates')->onDelete('cascade');
            $table->foreignId('arrival_gate')->constrained('gates')->onDelete('cascade');
            $table->foreignId('departure_airport_id')->constrained('airports')->onDelete('cascade');
            $table->foreignId('arrival_airport_id')->constrained('airports')->onDelete('cascade');
            $table->enum('status', ['arrived', 'canceled', 'Delayed', 'departed', 'On Time'])->default('On Time');
            $table->unsignedSmallInteger('total_capacity');
            $table->date('arrival_date');
            $table->date('departure_date');
            $table->time('arrival_time');
            $table->time('departure_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
