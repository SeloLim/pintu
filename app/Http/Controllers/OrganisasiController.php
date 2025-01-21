<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Organisasi;
use App\Models\User;

class OrganisasiController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'kode_organisasi' => 'required|unique:organisasi,kode_organisasi',
            'nama_organisasi' => 'required',
            'tipe_organisasi' => 'required',
            'status_organisasi' => 'required',
            'tahun_berdiri' => 'required|integer|min:1900|max:' . date('Y'),
        ], [
            'kode_organisasi.required' => 'Kode organisasi wajib diisi.',
            'kode_organisasi.unique' => 'Kode organisasi sudah terdaftar.',
            'nama_organisasi.required' => 'Nama organisasi wajib diisi.',
            'tipe_organisasi.required' => 'Tipe organisasi wajib diisi.',
            'status_organisasi.required' => 'Status organisasi wajib diisi.',
            'tahun_berdiri.required' => 'Tahun berdiri wajib diisi.',
            'tahun_berdiri.integer' => 'Tahun berdiri harus berupa angka.',
            'tahun_berdiri.min' => 'Tahun berdiri tidak valid.',
            'tahun_berdiri.max' => 'Tahun berdiri tidak valid.',
        ]);

        Organisasi::create([
            'kode_organisasi' => $request->kode_organisasi,
            'nama_organisasi' => $request->nama_organisasi,
            'tipe_organisasi' => $request->tipe_organisasi,
            'status_organisasi' => $request->status_organisasi,
            'tahun_berdiri' => $request->tahun_berdiri,
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'kode_organisasi' => $request->kode_organisasi,
        ]);

        return redirect()->back()->with('success', 'Organisasi berhasil ditambahkan.');
    }

    public function index(Request $request)
    {
        $query = Organisasi::query();

        // Wrap search conditions in closure
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('nama_organisasi', 'LIKE', "%{$search}%")
                ->orWhere('kode_organisasi', 'LIKE', "%{$search}%");
            });
        }

        // Apply status filter after search
        if ($request->has('status') && $request->status !== null) {
            $query->where('status_organisasi', $request->status);
        }

        $perPage = $request->input('per_page', 10);
        $organisasis = $query->paginate($perPage)->withQueryString();

        return view('layouts.super_admin.manajemen-organisasi', compact('organisasis'));
    }

    public function update(Request $request, $kode_organisasi)
    {
        $organisasi = Organisasi::where('kode_organisasi', $kode_organisasi)->firstOrFail();
        
        $organisasi->update([
            'nama_organisasi' => $request->nama_organisasi,
            'tipe_organisasi' => $request->tipe_organisasi,
            'status_organisasi' => $request->status_organisasi,
            'tahun_berdiri' => $request->tahun_berdiri,
        ]);

        return redirect()->route('manajemen-organisasi')
            ->with('success', 'Organisasi berhasil diperbarui');
    }

    public function destroy($kode_organisasi)
    {
        try {
            \Log::info('Attempting to delete organization:', ['kode_organisasi' => $kode_organisasi]);
            
            $organisasi = Organisasi::where('kode_organisasi', $kode_organisasi)->firstOrFail();
            
            if (User::where('kode_organisasi', $organisasi->kode_organisasi)->exists()) {
                \Log::info('Cannot delete - organization has admin');
                return redirect()
                    ->route('manajemen-organisasi')
                    ->with('alert', 'Organisasi tidak dapat dihapus karena masih memiliki admin.');
            }

            $organisasi->delete();
            \Log::info('Organization deleted successfully');
            
            return redirect()
                ->route('manajemen-organisasi')
                ->with('success', 'Organisasi berhasil dihapus.');
                
        } catch (\Exception $e) {
            \Log::error('Error deleting organization:', ['error' => $e->getMessage()]);
            return redirect()
                ->route('manajemen-organisasi')
                ->with('alert', 'Terjadi kesalahan saat menghapus organisasi.');
        }
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'deskripsi_organisasi' => 'required',
            'organisasi_picture' => 'required|image|mimes:jpeg,png,jpg|max:10240',
            'email_kontak' => 'email|nullable',
            'telepon_kontak' => 'numeric|nullable',
        ], [
            'deskripsi_organisasi.required' => 'Deskripsi organisasi wajib diisi.',
            'organisasi_picture.required' => 'Foto organisasi wajib diunggah.',
            'organisasi_picture.image' => 'Foto organisasi harus berupa gambar.',
            'organisasi_picture.mimes' => 'Foto organisasi harus berformat jpeg, png, jpg.',
            'organisasi_picture.max' => 'Foto organisasi tidak boleh lebih dari 10MB.',
            'email_kontak.email' => 'Email kontak tidak valid.',
            'telepon_kontak.numeric' => 'Telepon kontak harus berupa angka.',
        ]);
        
        $organisasi = Organisasi::where('kode_organisasi', auth()->user()->kode_organisasi)->firstOrFail();
        
        if ($request->hasFile('organisasi_picture')) {
            $file = $request->file('organisasi_picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/organisasi_pictures'), $filename);
            $organisasi->organisasi_picture = 'uploads/organisasi_pictures/' . $filename;
        }

        

        $organisasi->deskripsi_organisasi = $request->deskripsi_organisasi;
        $organisasi->email_kontak = $request->email_kontak;
        $organisasi->telepon_kontak = $request->telepon_kontak;
        $organisasi->save();
        
        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}
