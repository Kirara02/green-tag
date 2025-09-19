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
        Schema::create('collection_routes', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "Rute Pagi Area Sakura"
            $table->string('day');  // e.g., Monday, Tuesday
            $table->time('start_time');
            $table->time('end_time');
            $table->foreignId('officer_in_charge_id')->nullable()->constrained('users'); // Penanggung jawab rute
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collection_routes');
    }
};
