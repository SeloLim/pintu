<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;

    protected $table = 'divisi'; // Nama tabel
    protected $primaryKey = 'kode_divisi'; // Primary key
    public $incrementing = false; // Karena primary key bukan auto-increment
    protected $keyType = 'string'; // Primary key berupa string

    protected $fillable = [
        'kode_divisi',
        'kode_organisasi',
        'nama_divisi',
        'alias_divisi',
        'deskripsi_divisi',
        'status_divisi',
    ];

    // Relasi ke tabel Organisasi
    public function organisasi()
    {
        return $this->belongsTo(Organisasi::class, 'kode_organisasi', 'kode_organisasi');
    }

    public static function generateKodeDivisi($kodeOrganisasi, $aliasDivisi)
    {
        $prefix = "DIV_{$kodeOrganisasi}_{$aliasDivisi}";
        return $prefix;
    }
}
