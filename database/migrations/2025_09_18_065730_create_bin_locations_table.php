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
        Schema::create('bin_locations', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // e.g. LOC-SAKURA02
            $table->string('name');           // Location name
            $table->string('address');        // Detailed address
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bin_locations');
    }
};
