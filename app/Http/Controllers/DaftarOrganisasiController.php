<?php

namespace App\Http\Controllers;

use App\Models\Organisasi;
use Illuminate\Http\Request;

class DaftarOrganisasiController extends Controller
{
    public function index()
    {
        $organisasis = Organisasi::orderByRaw("CASE 
            WHEN tipe_organisasi = 'ormawa' THEN 1 
            WHEN tipe_organisasi = 'ukm' THEN 2 
            ELSE 3 END")
            ->paginate(12);

        return view('layouts.user.daftar-organisasi', compact('organisasis'));
    }
}