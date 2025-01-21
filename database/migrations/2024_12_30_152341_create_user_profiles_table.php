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
        Schema::create('user_profiles', function (Blueprint $table) {
        $table->id();
        $table->string('user_username'); // Ganti dari user_id ke user_username
        $table->string('nama_lengkap')->nullable(); // Tambahkan kolom nama lengkap
        $table->string('profile_picture')->nullable(); // Tambahkan kolom untuk menyimpan path profile picture
        $table->string('nim')->unique();
        $table->string('kelas')->nullable();
        $table->string('program_studi')->nullable();
        $table->string('tempat_lahir')->nullable();
        $table->date('tanggal_lahir')->nullable();
        $table->string('nomor_handphone')->nullable();
        $table->text('alamat')->nullable();
        $table->text('minat_hobi')->nullable();
        $table->timestamps();

        // Menghubungkan kolom user_username ke kolom username pada tabel users
        $table->foreign('user_username')->references('username')->on('users')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
