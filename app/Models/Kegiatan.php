<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';
    protected $primaryKey = 'kode_kegiatan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_kegiatan',
        'kode_organisasi',
        'kode_divisi', 
        'nama_kegiatan',
        'tanggal_mulai',
        'lokasi_kegiatan',
        'penanggung_jawab',
        'deskripsi_kegiatan',
        'status_kegiatan',
        'gambar_kegiatan'
    ];

    public static function generateKodeKegiatan($kodeOrganisasi, $kodeDivisi)
    {
        $prefix = "KG_{$kodeOrganisasi}_{$kodeDivisi}_";
        
        // Get last number
        $lastKegiatan = self::where('kode_kegiatan', 'LIKE', $prefix . '%')
            ->orderBy('kode_kegiatan', 'desc')
            ->first();

        if (!$lastKegiatan) {
            return $prefix . '01';
        }

        // Extract number and increment
        $lastNumber = intval(substr($lastKegiatan->kode_kegiatan, -2));
        $newNumber = str_pad($lastNumber + 1, 2, '0', STR_PAD_LEFT);
        
        return $prefix . $newNumber;
    }

    public function organisasi()
    {
        return $this->belongsTo(Organisasi::class, 'kode_organisasi', 'kode_organisasi');
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'kode_divisi', 'kode_divisi');
    }

    public function penanggungJawab()
    {
        return $this->belongsTo(Anggota::class, 'penanggung_jawab', 'username')
                    ->with('user_profile:user_username,nim,nama_lengkap');
    }
}

