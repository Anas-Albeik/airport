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
            $table->foreignId('gate_id')->constrained('gates')->onDelete('cascade');
            $table->foreignId('origin_id')->constrained('airports')->onDelete('cascade');
            $table->foreignId('destination_id')->constrained('airports')->onDelete('cascade');
            $table->enum('Scheduled', ['arrived', 'canceled', 'Delayed', 'departed', 'On Time'])->default('On Time');
            $table->dateTime('departure_time')->nullable();
            $table->dateTime('arrival_time')->nullable();
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
