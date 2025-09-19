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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bin_id')->constrained('bins')->cascadeOnDelete();
            $table->string('reporter_name');
            $table->string('reporter_phone')->nullable();
            $table->text('address_detail');
            $table->enum('category', ['garbage_pile', 'odor', 'full_bin', 'broken_bin', 'other']);
            $table->text('description');
            $table->string('photo')->nullable();
            $table->enum('status', ['new', 'in_progress', 'resolved'])->default('new');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
