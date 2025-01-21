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
        Schema::create('divisi', function (Blueprint $table) {
            $table->string('kode_divisi', 20)->primary();
            $table->string('kode_organisasi', 20);
            $table->string('alias_divisi', 20);
            $table->string('nama_divisi', 100);
            $table->text('deskripsi_divisi')->nullable();
            $table->enum('status_divisi', ['Aktif', 'Non-Aktif'])->default('Aktif');
            $table->timestamps();

            $table->foreign('kode_organisasi')
                ->references('kode_organisasi')
                ->on('organisasi')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('divisi');
    }
};
