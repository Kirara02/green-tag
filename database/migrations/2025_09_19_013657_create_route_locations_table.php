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
        Schema::create('route_location', function (Blueprint $table) {
            $table->primary(['collection_route_id', 'bin_location_id']); // Composite primary key
            $table->foreignId('collection_route_id')->constrained('collection_routes')->cascadeOnDelete();
            $table->foreignId('bin_location_id')->constrained('bin_locations')->cascadeOnDelete();
            $table->unsignedSmallInteger('sequence')->default(1); // Urutan pengambilan di rute tsb
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('route_locations');
    }
};
