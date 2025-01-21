<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Anggota;
use App\Models\Divisi;
use App\Models\UserProfile;


class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        $query = Anggota::with(['user_profile', 'divisi']);
        
        // Filter by user's organization
        $kode_organisasi = auth()->user()->kode_organisasi;
        $query->where('kode_organisasi', $kode_organisasi);

        // Filter by divisi
        if ($request->has('divisi') && $request->divisi !== null) {
            $query->where('kode_divisi', $request->divisi);
        }

        // Filter by jabatan
        if ($request->has('jabatan') && $request->jabatan !== null) {
            $query->where('jabatan', $request->jabatan);
        }

        // Filter by status
        if ($request->has('status') && $request->status !== null) {
            $query->where('status_keanggotaan', $request->status);
        }

        // Get divisi for dropdown
        $divisis = Divisi::where('kode_organisasi', $kode_organisasi)->get();

        // Search functionality
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('user_profile', function($q) use ($search) {
                $q->where('nama_lengkap', 'LIKE', "%{$search}%")
                  ->orWhere('nim', 'LIKE', "%{$search}%");
            });
        }

        // Status filter
        if ($request->has('status') && $request->status !== null) {
            $query->where('status_keanggotaan', $request->status);
        }

        $perPage = $request->input('per_page', 10);
        $anggotas = $query->paginate($perPage)->withQueryString();
    
        return view('layouts.admin.manajemen-anggota', compact('anggotas', 'divisis'));
    }

    public function store(Request $request)
    {
        
        $kode_organisasi = auth()->user()->kode_organisasi;
        $kode_anggota = Anggota::generateKodeAnggota($kode_organisasi);

        $username = UserProfile::where('nim', $request->nim)->value('user_username');
        if (!$username) {
            return redirect()->back()->withErrors(['nim' => 'NIM tidak ditemukan'])->withInput();
        }
        $request->merge(['username' => $username]);
        $request->merge(['kode_anggota' => $kode_anggota]);

        // Check if combination exists
        $exists = Anggota::where('kode_divisi', $request->kode_divisi)->where('jabatan', $request->jabatan)->exists();

        if($exists && in_array($request->jabatan, ['Ketua', 'Wakil Ketua', 'Sekretaris', 'Bendahara'])) {
            return redirect()->back()->withErrors(['combination' => 'Jabatan tersebut sudah terisi di divisi ini'])->withInput();
        }

        // Check if user already exists in organization
        $existingMember = Anggota::where('username', $request->username)->where('kode_organisasi', $kode_organisasi)->first();

        if ($existingMember) {
        return redirect()->back()
            ->withErrors(['username' => 'Anggota sudah terdaftar di organisasi ini'])
            ->withInput();
        }

        $request->validate([
            'kode_anggota' => 'required|unique:anggota',
            'username' => 'required|exists:user_profiles,user_username',
            'kode_divisi' => 'required|exists:divisi,kode_divisi',
            'jabatan' => 'required',
            'status_keanggotaan' => 'required|in:Aktif,Non-Aktif',
        ], [
            'kode_anggota.required' => 'Kode anggota wajib diisi.',
            'kode_anggota.unique' => 'Kode anggota sudah terdaftar.',
            'username.required' => 'Username wajib diisi',
            'username.exists' => 'Username tidak valid.',
            'kode_divisi.required' => 'Divisi wajib diisi.',
            'kode_divisi.exists' => 'Divisi tidak valid.',
            'jabatan.required' => 'Jabatan wajib diisi.',
            'status_keanggotaan.required' => 'Status keanggotaan wajib diisi.',
        ]);

        Anggota::create([
            'kode_anggota' => $kode_anggota,
            'kode_organisasi' => $kode_organisasi,
            'username' => $request->username,
            'kode_divisi' => $request->kode_divisi,
            'jabatan' => $request->jabatan,
            'status_keanggotaan' => $request->status_keanggotaan,
        ]);

        return redirect()->back()->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function update(Request $request, $username)
    {
        $kode_organisasi = auth()->user()->kode_organisasi;
        
        $request->validate([
            'kode_divisi' => 'required|exists:divisi,kode_divisi',
            'jabatan' => 'required',
            'status_keanggotaan' => 'required|in:Aktif,Non-Aktif',
        ]);

        $anggota = Anggota::where('username', $username)
                        ->where('kode_organisasi', $kode_organisasi)
                        ->firstOrFail();

        // Check if combination exists (excluding current anggota)
        $exists = Anggota::where('kode_divisi', $request->kode_divisi)
                        ->where('jabatan', $request->jabatan)
                        ->where('kode_organisasi', $kode_organisasi)
                        ->where('username', '!=', $username)
                        ->exists();

        if($exists && in_array($request->jabatan, ['Ketua', 'Wakil Ketua', 'Sekretaris', 'Bendahara'])) {
            return redirect()->back()
                            ->withErrors(['combination' => 'Jabatan tersebut sudah terisi di divisi ini'])
                            ->withInput();
        }

        try {
            $anggota->update([
                'kode_divisi' => $request->kode_divisi,
                'jabatan' => $request->jabatan,
                'status_keanggotaan' => $request->status_keanggotaan,
            ]);

            return redirect()->route('manajemen-anggota')
                            ->with('success', 'Data anggota berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()
                            ->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data'])
                            ->withInput();
        }
    }

    public function destroy($username)
    {
        try {
            $anggota = Anggota::where('username', $username)->firstOrFail();
            $anggota->delete();
            
            return redirect()
                ->route('manajemen-anggota')
                ->with('success', 'Anggota berhasil dihapus.');
                
        } catch (\Exception $e) {
            return redirect()
                ->route('manajemen-anggota')
                ->with('alert', 'Terjadi kesalahan saat menghapus anggota.');
        }
    }

    public function statusKeanggotaan(Request $request)
    {
        $query = Anggota::with(['divisi', 'organisasi']);
        
        // Filter by user's username
        $query->where('username', auth()->user()->username);

        $kode_organisasi = auth()->user()->kode_organisasi;
        $divisis = Divisi::all();

        // Search functionality
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('organisasi', function($q) use ($search) {
                $q->where('nama_organisasi', 'LIKE', "%{$search}%")
                  ->orWhere('kode_organisasi', 'LIKE', "%{$search}%");
            });
        }

        $perPage = $request->input('per_page', 10);
        $anggotas = $query->paginate($perPage)->withQueryString();
    
        return view('layouts.user.status-keanggotaan', compact('anggotas', 'divisis'));
    }
}