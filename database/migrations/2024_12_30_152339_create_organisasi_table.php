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
        Schema::create('organisasi', function (Blueprint $table) {
            $table->string('kode_organisasi', 20)->primary();
            $table->string('nama_organisasi', 100);
            $table->string('tipe_organisasi')->required();
            $table->string('organisasi_picture')->nullable();
            $table->string('status_organisasi')->required();
            $table->text('deskripsi_organisasi')->nullable();
            $table->year('tahun_berdiri')->required();
            $table->string('email_kontak', 100)->nullable();
            $table->string('telepon_kontak', 15)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organisasi');
    }
};
