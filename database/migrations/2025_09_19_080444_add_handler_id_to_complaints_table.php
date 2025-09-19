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
        Schema::table('complaints', function (Blueprint $table) {
            // Menambahkan kolom baru
            $table->foreignId('handler_id')
                  ->nullable() // Boleh kosong, karena awalnya tidak ada yang menangani
                  ->after('status') // (Opsional) Meletakkan kolom ini setelah kolom 'status'
                  ->constrained('users') // Membuat foreign key ke tabel 'users'
                  ->onDelete('set null'); // Jika user (petugas) dihapus, set handler_id menjadi NULL
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            // Logika untuk membatalkan (rollback) migrasi
            $table->dropForeign(['handler_id']);
            $table->dropColumn('handler_id');
        });
    }
};
