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
    Schema::create('airports', function (Blueprint $table) {
        $table->id();
        $table->foreignId('city_id')->constrained('cities')->onDelete('cascade');
        $table->string('name');
        $table->string('iata_code', 3)->unique();
        $table->string('location')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airports_migration');
    }
};
