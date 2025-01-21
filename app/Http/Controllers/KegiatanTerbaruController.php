<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanTerbaruController extends Controller
{
    public function index()
    {
        $latestKegiatan = Kegiatan::with(['organisasi', 'divisi'])
            ->where('status_kegiatan', 'Proses')
            ->orderBy('tanggal_mulai', 'desc')
            ->take(3)
            ->get();

        return view('layouts.user.kegiatan-terbaru', compact('latestKegiatan'));
    }
}