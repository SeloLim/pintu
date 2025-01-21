<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Divisi;
use App\Models\Organisasi;
use Illuminate\Validation\Rule;

class DivisiController extends Controller
{
    public function index(Request $request)
    {
        $query = Divisi::query();
        // Get user's organization code
        $kode_organisasi = auth()->user()->kode_organisasi;
        $query->where('kode_organisasi', $kode_organisasi);

        // Wrap search conditions in closure
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('nama_divisi', 'LIKE', "%{$search}%")
                ->orWhere('kode_divisi', 'LIKE', "%{$search}%");
            });
        }

        // Apply status filter after search
        if ($request->has('status') && $request->status !== null) {
            $query->where('status_divisi', $request->status);
        }

        $perPage = $request->input('per_page', 10);
        $divisis = $query->paginate($perPage)->withQueryString();

        return view('layouts.admin.manajemen-divisi', compact('divisis'));
    }

    public function store(Request $request)
    {
        $kode_organisasi = auth()->user()->kode_organisasi;
        $alias_divisi = $request->alias_divisi;
        $kode_divisi = Divisi::generateKodeDivisi($kode_organisasi, $alias_divisi);

        $request->merge(['kode_divisi' => $kode_divisi]);

        $request->validate([
            'kode_divisi' => 'required|unique:divisi',
            'alias_divisi' => [
                'required',
                Rule::unique('divisi')->where(function ($query) use ($kode_organisasi) {
                    return $query->where('kode_organisasi', $kode_organisasi);
                })
            ],
            'nama_divisi' => 'required',
            'status_divisi' => 'required',
            'deskripsi_divisi' => 'required',
        ], [
            'kode_divisi.required' => 'Kode divisi wajib diisi.',
            'kode_divisi.unique' => 'Kode divisi sudah terdaftar.',
            'alias_divisi.required' => 'Alias divisi wajib diisi.',
            'alias_divisi.unique' => 'Alias divisi sudah terdaftar.',
            'nama_divisi.required' => 'Nama divisi wajib diisi.',
            'status_divisi.required' => 'Status divisi wajib diisi.',
            'deskripsi_divisi.required' => 'Deskripsi divisi wajib diisi.',
        ]);

        Divisi::create([
            'kode_divisi' => $kode_divisi,
            'nama_divisi' => $request->nama_divisi,
            'alias_divisi' => $request->alias_divisi,
            'status_divisi' => $request->status_divisi,
            'deskripsi_divisi' => $request->deskripsi_divisi,
            'kode_organisasi' => $kode_organisasi,
        ]);

        return redirect()->back()->with('success', 'Organisasi berhasil ditambahkan.');
    }

    public function update(Request $request, $kode_divisi)
    {
        $divisi = Divisi::where('kode_divisi', $kode_divisi)->firstOrFail();
        
        $divisi->update([
            'nama_divisi' => $request->nama_divisi,
            'deskripsi_divisi' => $request->deskripsi_divisi,
            'status_divisi' => $request->status_divisi,
            
        ]);

        return redirect()->route('manajemen-divisi')
            ->with('success', 'Divisi berhasil diperbarui');
    }

    public function destroy($kode_divisi)
    {
        try {
            \Log::info('Attempting to delete division:', ['kode_divisi' => $kode_divisi]);
            
            $divisi = Divisi::where('kode_divisi', $kode_divisi)->firstOrFail();
            
            $divisi->delete();
            \Log::info('Division deleted successfully');
            
            return redirect()
                ->route('manajemen-divisi')
                ->with('success', 'Divisi berhasil dihapus.');
                
        } catch (\Exception $e) {
            \Log::error('Error deleting division:', ['error' => $e->getMessage()]);
            return redirect()
                ->route('manajemen-divisi')
                ->with('alert', 'Terjadi kesalahan saat menghapus divisi.');
        }
    }
}
