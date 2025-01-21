<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Organisasi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $kegiatanTerbaru = Kegiatan::with(['organisasi', 'divisi'])
            ->where('status_kegiatan', 'Proses')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        $organisasi = Organisasi::orderByRaw("CASE 
            WHEN tipe_organisasi = 'ormawa' THEN 1 
            WHEN tipe_organisasi = 'ukm' THEN 2 
            ELSE 3 END")
            ->get();
        
        $riwayatKegiatan = Kegiatan::with(['organisasi', 'divisi'])
            ->where('status_kegiatan', 'Terlaksana')
            ->orderBy('tanggal_selesai', 'desc')
            ->take(5)
            ->get();

        

        if ($user->role === 'super_admin') {
            return view('layouts.super_admin.dashboard');
        } elseif ($user->role === 'admin') {
            return view('layouts.admin.dashboard');
        } elseif ($user->role === 'user') {
            return view('layouts.user.dashboard', compact('kegiatanTerbaru', 'organisasi', 'riwayatKegiatan'));
        }

        abort(403, 'Unauthorized');
    }
}