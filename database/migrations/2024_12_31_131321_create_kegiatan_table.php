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
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->string('kode_kegiatan', 50)->primary();
            $table->string('kode_organisasi', 20);
            $table->string('kode_divisi', 20);
            $table->string('nama_kegiatan', 100);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();
            $table->string('lokasi_kegiatan')->nullable();
            $table->string('penanggung_jawab')->nullable();
            $table->text('deskripsi_kegiatan')->nullable();
            $table->enum('status_kegiatan', ['Proses', 'Terlaksana', 'Dibatalkan'])->default('Proses');
            $table->string('gambar_kegiatan')->nullable();
            $table->timestamps();
        
            $table->foreign('kode_organisasi')->references('kode_organisasi')->on('organisasi')->onDelete('cascade');
            $table->foreign('kode_divisi')->references('kode_divisi')->on('divisi')->onDelete('cascade');
            $table->foreign('penanggung_jawab')->references('username')->on('anggota')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan');
    }
};
