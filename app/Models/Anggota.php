<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggota';
    protected $primaryKey = 'username';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_anggota',
        'kode_organisasi',
        'username',
        'kode_divisi',
        'jabatan',
        'status_keanggotaan'
    ];

    public function user_profile()
    {
        return $this->belongsTo(UserProfile::class, 'username', 'user_username');
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'kode_divisi', 'kode_divisi');
    }

    public function organisasi()
    {
        return $this->belongsTo(Organisasi::class, 'kode_organisasi', 'kode_organisasi');
    }

    public static function generateKodeAnggota($kodeOrganisasi)
    {
        $prefix = "AGT_{$kodeOrganisasi}_";
        
        // Get last number
        $lastAnggota = self::where('kode_anggota', 'LIKE', $prefix . '%')
            ->orderBy('kode_anggota', 'desc')
            ->first();

        if (!$lastAnggota) {
            return $prefix . '01';
        }

        // Extract number and increment
        $lastNumber = intval(substr($lastAnggota->kode_anggota, -2));
        $newNumber = str_pad($lastNumber + 1, 2, '0', STR_PAD_LEFT);
        
        return $prefix . $newNumber;
    }

    
}