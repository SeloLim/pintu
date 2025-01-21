<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kepengurusan extends Model
{
    protected $table = 'kepengurusan';
    protected $primaryKey = 'kode_kepengurusan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_kepengurusan',
        'kode_organisasi',
        'username',
        'jabatan',
        'periode'
    ];

    public function organisasi()
    {
        return $this->belongsTo(Organisasi::class, 'kode_organisasi', 'kode_organisasi');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }
}