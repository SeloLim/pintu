<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class RiwayatKegiatanController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::with(['organisasi', 'divisi', 'penanggungJawab.user_profile'])
            ->orderBy('status_kegiatan', 'asc')
            ->orderBy('tanggal_mulai', 'desc')
            ->paginate(12);

        return view('layouts.user.riwayat-kegiatan', compact('kegiatans'));
    }
}