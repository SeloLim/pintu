<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Add these to the existing imports, then your insertion code will work:
        DB::table('users')->insert([
            'username' => 'super_admin',
            'role' => 'super_admin',
            'email' => 'super_admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('organisasi')->insert([
            'kode_organisasi' => 'HIMSI',
            'nama_organisasi' => 'Himpunan Mahasiswa Sistem Informasi',
            'tipe_organisasi' => 'Ormawa',
            'status_organisasi' => 'Aktif',
            'tahun_berdiri' => 2022,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'username' => 'admin_himsi',
            'role' => 'admin',
            'kode_organisasi' => 'HIMSI',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('organisasi')->insert([
            'kode_organisasi' => 'PMK',
            'nama_organisasi' => 'Perkumpulan Mahasiswa Kristen',
            'tipe_organisasi' => 'UKM',
            'status_organisasi' => 'Aktif',
            'tahun_berdiri' => 2020,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'username' => 'admin_pmk',
            'role' => 'admin',
            'kode_organisasi' => 'PMK',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('organisasi')->insert([
            'kode_organisasi' => 'GDGOC',
            'nama_organisasi' => 'Google Developer Group Open Campus',
            'tipe_organisasi' => 'UKM',
            'status_organisasi' => 'Aktif',
            'tahun_berdiri' => 2022,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'username' => 'admin_gdgoc',
            'role' => 'admin',
            'kode_organisasi' => 'GDGOC',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('organisasi')->insert([
            'kode_organisasi' => 'Dummy1',
            'nama_organisasi' => 'Dummy Organisasi 1',
            'tipe_organisasi' => 'UKM',
            'status_organisasi' => 'Non-Aktif',
            'tahun_berdiri' => 2020,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'username' => 'admin_dummy1',
            'role' => 'admin',
            'kode_organisasi' => 'Dummy1',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('organisasi')->insert([
            'kode_organisasi' => 'Dummy2',
            'nama_organisasi' => 'Dummy Organisasi 2',
            'tipe_organisasi' => 'UKM',
            'status_organisasi' => 'Non-Aktif',
            'tahun_berdiri' => 2021,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'username' => 'admin_dummy2',
            'role' => 'admin',
            'kode_organisasi' => 'Dummy2',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('organisasi')->insert([
            'kode_organisasi' => 'Dummy3',
            'nama_organisasi' => 'Dummy Organisasi 3',
            'tipe_organisasi' => 'UKM',
            'status_organisasi' => 'Non-Aktif',
            'tahun_berdiri' => 2022,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'username' => 'admin_dummy3',
            'role' => 'admin',
            'kode_organisasi' => 'Dummy3',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'username' => 'selo',
            'role' => 'user',
            'password' => Hash::make('password'),
            'email' => 'alexlim983@gmail.com',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('user_profiles')->insert([
            'user_username' => 'selo',
            'nama_lengkap' => 'Alexandre Wijaya Lim',
            'nim' => '1201225092',
            'kelas' => 'SI-22-002',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        DB::table('users')->insert([
            'username' => 'mayleen',
            'role' => 'user',
            'password' => Hash::make('password'),
            'email' => 'ainaira@gmail.com',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('user_profiles')->insert([
            'user_username' => 'mayleen',
            'nama_lengkap' => 'Ainaira Dianisa',
            'nim' => '1201225091',
            'kelas' => 'SI-22-002',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
