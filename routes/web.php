<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Role;
use App\Http\Middleware\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RiwayatKegiatanController;
use App\Http\Controllers\DaftarOrganisasiController;
use App\Http\Controllers\KegiatanTerbaruController;



Route::get('/', function () {
    return redirect()->route('dashboard');
})-> middleware(Auth::class);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login') ;
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/settings/update-password', [AuthController::class, 'updatePassword'])->name('settings.update-password')->middleware([Auth::class]);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware([Auth::class]);

Route::get('/profile', function () {
    // Mendapatkan pengguna yang sedang login
    $user = auth()->user();
    // Periksa role dan arahkan ke layout yang sesuai
    if ($user->role === 'super_admin') {
        return view('layouts.super_admin.profile'); // View untuk admin
    } elseif ($user->role === 'admin') {
        return view('layouts.admin.profile'); // View untuk super_admin
    } elseif ($user->role === 'user') {
        return view('layouts.user.profile'); // View untuk user
    }
    abort(403, 'Unauthorized'); // Atau redirect ke halaman lain
})->name('profile')->middleware([Auth::class]);

Route::get('/settings', function () {
    // Mendapatkan pengguna yang sedang login
    $user = auth()->user();
    // Periksa role dan arahkan ke layout yang sesuai
    if ($user->role === 'super_admin') {
        return view('layouts.super_admin.settings'); // View untuk admin
    } elseif ($user->role === 'admin') {
        return view('layouts.admin.settings'); // View untuk super_admin
    } elseif ($user->role === 'user') {
        return view('layouts.user.settings'); // View untuk user
    }
    abort(403, 'Unauthorized'); // Atau redirect ke halaman lain
})->name('settings')->middleware([Auth::class]);

Route::get('/edit-profile', function () {
    $user = auth()->user();
    if ($user->role === 'user') {
        return view('layouts.user.edit-profile');
    }elseif ($user->role === 'admin') {
        return view('layouts.admin.edit-profile');
    }
    abort(403, 'Unauthorized');
})->name('edit-profile')->middleware([Auth::class]);

Route::middleware([Auth::class, Role::class . ':user'])->group(function () {
    Route::get('/kegiatan-terbaru', [KegiatanTerbaruController::class, 'index'])
    ->name('kegiatan-terbaru')
    ->middleware('auth');

    Route::get('/daftar-organisasi', function () {
        return view('layouts.user.daftar-organisasi');
    })->name('daftar-organisasi');

    Route::get('/riwayat-kegiatan', [RiwayatKegiatanController::class, 'index'])->name('riwayat-kegiatan');

    Route::get('/status-keanggotaan', [AnggotaController::class, 'statusKeanggotaan'])->name('status-keanggotaan');

    Route::get('/daftar-organisasi', [DaftarOrganisasiController::class, 'index'])
    ->name('daftar-organisasi')
    ->middleware('auth');

    Route::post('/profile/update', [UserProfileController::class, 'updateProfile'])->name('profile.update');
});

Route::middleware([Auth::class, Role::class . ':admin'])->group(function () {
    Route::get('/manajemen-divisi', [DivisiController::class, 'index'])->name('manajemen-divisi');
    Route::get('/manajemen-anggota', [AnggotaController::class, 'index'])->name('manajemen-anggota');
    Route::get('/manajemen-kegiatan', [KegiatanController::class, 'index'])->name('manajemen-kegiatan');

    Route::post('/divisi/store', [DivisiController::class, 'store'])->name('divisi.store');
    Route::put('/divisi/{kode_divisi}', [DivisiController::class, 'update'])->name('divisi.update');
    Route::delete('/divisi/{kode_divisi}', [DivisiController::class, 'destroy'])->name('divisi.destroy');

    Route::post('/anggota/store', [AnggotaController::class, 'store'])->name('anggota.store');
    Route::put('/anggota/{username}', [AnggotaController::class, 'update'])->name('anggota.update');
    Route::delete('/anggota/{username}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');

    Route::post('/kegiatan/store', [KegiatanController::class, 'store'])->name('kegiatan.store');
    Route::put('/kegiatan/{kode_kegiatan}', [KegiatanController::class, 'update'])->name('kegiatan.update');
    Route::delete('/kegiatan/{kode_kegiatan}', [KegiatanController::class, 'destroy'])->name('kegiatan.destroy');

    Route::post('/admin-profile/update', [OrganisasiController::class, 'updateProfile'])->name('admin-profile.update');
});

Route::middleware([Auth::class, Role::class . ':super_admin'])->group(function () {
    Route::get('/manajemen-organisasi', [OrganisasiController::class, 'index'])->name('manajemen-organisasi');
    Route::get('/manajemen-admin', [AdminController::class, 'index'])->name('manajemen-admin');

    Route::post('/organisasi/store', [OrganisasiController::class, 'store'])->name('organisasi.store');
    Route::put('/organisasi/{kode_organisasi}', [OrganisasiController::class, 'update'])->name('organisasi.update');
    Route::delete('/organisasi/{kode_organisasi}', [OrganisasiController::class, 'destroy'])->name('organisasi.destroy');

    Route::delete('/admin/{username}', [AdminController::class, 'destroy'])->name('admin.destroy');
});

