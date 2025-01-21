<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Drop table without checking foreign keys first
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('anggota');
        Schema::enableForeignKeyConstraints();
        
        Schema::create('anggota', function (Blueprint $table) {
            $table->string('kode_anggota')->primary();
            $table->string('kode_organisasi');
            $table->string('username');
            $table->string('kode_divisi')->nullable();
            $table->string('jabatan')->nullable();
            $table->enum('status_keanggotaan', ['Aktif', 'Non-Aktif'])->default('Aktif');
            $table->timestamps();

            $table->foreign('username')->references('username')->on('users')->onDelete('cascade');
            $table->foreign('kode_organisasi')->references('kode_organisasi')->on('organisasi')->onDelete('cascade');
            $table->foreign('kode_divisi')->references('kode_divisi')->on('divisi')->onDelete('set null');
            $table->unique(['username', 'kode_organisasi']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('anggota');
    }
};