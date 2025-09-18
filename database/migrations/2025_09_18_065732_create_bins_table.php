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
        Schema::create('bins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bin_location_id')->constrained('bin_locations')->cascadeOnDelete();
            $table->string('code')->unique();     // e.g. BIN-PLASTIC01
            $table->string('qr_token')->unique(); // unique token for QR Code (UUID or random string)
            $table->string('description')->nullable(); // e.g. "Plastic Bin"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bins');
    }
};
