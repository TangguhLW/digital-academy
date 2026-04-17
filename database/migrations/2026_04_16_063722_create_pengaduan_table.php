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
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->enum('klasifikasi', ['pengaduan', 'aspirasi', 'permintaan_informasi'])->default('pengaduan');
            $table->string('judul');
            $table->text('isi_laporan');
            $table->string('foto')->nullable();
            $table->date('tanggal_kejadian')->nullable();
            $table->enum('status', ['pending', 'diproses', 'selesai'])->default('pending');
            $table->boolean('is_anonim')->default(false);
            $table->timestamp('tanggal_lapor')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};
