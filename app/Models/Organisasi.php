<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisasi extends Model
{
    use HasFactory;

    protected $table = 'organisasi'; // Nama tabel
    protected $primaryKey = 'kode_organisasi'; // Primary key
    public $incrementing = false; // Karena kode_organisasi bukan auto-increment
    protected $keyType = 'string'; // Primary key berupa string

    protected $fillable = [
        'kode_organisasi',
        'nama_organisasi',
        'deskripsi_organisasi',
        'tipe_organisasi',
        'status_organisasi',
        'tahun_berdiri',
        'email_kontak',
        'telepon_kontak',
    ];

    // Relasi ke tabel Anggota
    public function anggota()
    {
        return $this->hasMany(Anggota::class, 'kode_organisasi', 'kode_organisasi');
    }

    // Relasi ke tabel Divisi
    public function divisi()
    {
        return $this->hasMany(Divisi::class, 'kode_organisasi', 'kode_organisasi');
    }

    // Relasi ke tabel Kegiatan
    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class, 'kode_organisasi', 'kode_organisasi');
    }
}
