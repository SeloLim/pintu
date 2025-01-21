<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
    {
        protected $fillable = [
            'user_username',
            'nama_lengkap',
            'profile_picture',
            'nim',
            'kelas',
            'program_studi',
            'tempat_lahir',
            'tanggal_lahir',
            'nomor_handphone',
            'alamat',
            'minat_hobi'
        ];

        public function user()
        {
            return $this->belongsTo(User::class, 'user_username', 'username');
        }
    }
