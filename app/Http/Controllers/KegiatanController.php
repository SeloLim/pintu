<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\Divisi;
use App\Models\UserProfile;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        $query = Kegiatan::with(['divisi']);
        
        // Filter by user's organization
        $kode_organisasi = auth()->user()->kode_organisasi;
        $query->where('kode_organisasi', $kode_organisasi);

        // Filter by divisi
        if ($request->has('divisi') && $request->divisi !== null) {
            $query->where('kode_divisi', $request->divisi);
        }

        // Search functionality
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('nama_kegiatan', 'LIKE', "%{$search}%")
                ->orWhere('kode_kegiatan', 'LIKE', "%{$search}%")
                ->orWhereHas('divisi', function($q) use ($search) {
                    $q->where('nama_divisi', 'LIKE', "%{$search}%");
                });
            });
        }

        // Status filter
        if ($request->has('status') && $request->status !== null) {
            $query->where('status_kegiatan', $request->status);
        }

        // Get divisi for dropdown
        $divisis = Divisi::where('kode_organisasi', $kode_organisasi)->get();

        $perPage = $request->input('per_page', 10);
        $kegiatans = $query->paginate($perPage)->withQueryString();

        return view('layouts.admin.manajemen-kegiatan', compact('kegiatans', 'divisis'));
    }

    public function store(Request $request)
    {
        $kode_organisasi = auth()->user()->kode_organisasi;
        $kode_divisi = $request->kode_divisi;
        $kode_kegiatan = Kegiatan::generateKodeKegiatan($kode_organisasi, $kode_divisi);

        $username = UserProfile::where('nim', $request->nim)->value('user_username');
        if (!$username) {
            return redirect()->back()->withErrors(['nim' => 'NIM tidak ditemukan'])->withInput();
        }
        
        $request->merge(['penanggung_jawab' => $username]);

        $request->validate([
            'nama_kegiatan' => 'required',
            'tanggal_mulai' => 'required',
            'lokasi_kegiatan' => 'required',
            'penanggung_jawab' => 'required|exists:anggota,username',
            'deskripsi_kegiatan' => 'required',
            'gambar_kegiatan' => 'required|image|mimes:jpeg,png,jpg|max:10240',
        ], [
            'nama_kegiatan.required' => 'Nama kegiatan wajib diisi',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi',
            'lokasi_kegiatan.required' => 'Lokasi kegiatan wajib diisi',
            'penanggung_jawab.required' => 'Penanggung jawab wajib diisi',
            'penanggung_jawab.exists' => 'Penanggung jawab tidak ditemukan',
            'deskripsi_kegiatan.required' => 'Deskripsi kegiatan wajib diisi',
            'gambar_kegiatan.required' => 'Gambar kegiatan wajib diisi',
            'gambar_kegiatan.image' => 'Gambar kegiatan harus berupa file gambar',
            'gambar_kegiatan.mimes' => 'Gambar kegiatan harus berupa file: jpeg, png, jpg',
            'gambar_kegiatan.max' => 'Gambar kegiatan tidak boleh lebih dari 10MB',
        ]);

        try {
            if ($request->hasFile('gambar_kegiatan')) {
                // Validate file
                $gambar_kegiatan = $request->file('gambar_kegiatan');
                if (!$gambar_kegiatan->isValid()) {
                    throw new \Exception('File upload failed');
                }
        
                // Generate unique filename
                $timestamp = now()->timestamp;
                $extension = $gambar_kegiatan->getClientOriginalExtension();
                $gambar_kegiatan_name = "{$kode_kegiatan}_{$timestamp}.{$extension}";

                $gambar_kegiatan->move(public_path('uploads/kegiatan'), $gambar_kegiatan_name);
                $filepath= 'uploads/kegiatan/' . $gambar_kegiatan_name;

                $kegiatan = new Kegiatan();
                $kegiatan->kode_kegiatan = $kode_kegiatan;
                $kegiatan->kode_organisasi = $kode_organisasi;
                $kegiatan->kode_divisi = $kode_divisi;
                $kegiatan->nama_kegiatan = $request->nama_kegiatan;
                $kegiatan->tanggal_mulai = $request->tanggal_mulai;
                $kegiatan->lokasi_kegiatan = $request->lokasi_kegiatan;
                $kegiatan->penanggung_jawab = $request->penanggung_jawab;
                $kegiatan->deskripsi_kegiatan = $request->deskripsi_kegiatan;
                $kegiatan->gambar_kegiatan = $filepath;
                $kegiatan->save();
            }
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['gambar_kegiatan' => 'Gagal mengupload gambar: ' . $e->getMessage()])
                ->withInput();
        }

        return redirect()->route('manajemen-kegiatan')->with('success', 'Kegiatan berhasil ditambahkan');
    }
    
    public function update(Request $request, $kode_kegiatan)
    {
        $kegiatan = Kegiatan::where('kode_kegiatan', $kode_kegiatan)->firstOrFail();

        $username = UserProfile::where('nim', $request->nim)->value('user_username');
        if (!$username) {
            return redirect()->back()->withErrors(['nim' => 'NIM tidak ditemukan'])->withInput();
        }
        
        $request->merge(['penanggung_jawab' => $username]);

        $request->validate([
            'nama_kegiatan' => 'required',
            'tanggal_mulai' => 'required',
            'lokasi_kegiatan' => 'required',
            'penanggung_jawab' => 'required|exists:anggota,username',
            'deskripsi_kegiatan' => 'required',
            'gambar_kegiatan' => 'image|mimes:jpeg,png,jpg|max:10240',
        ], [
            'nama_kegiatan.required' => 'Nama kegiatan wajib diisi',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi',
            'lokasi_kegiatan.required' => 'Lokasi kegiatan wajib diisi',
            'penanggung_jawab.required' => 'Penanggung jawab wajib diisi',
            'penanggung_jawab.exists' => 'Penanggung jawab tidak ditemukan',
            'deskripsi_kegiatan.required' => 'Deskripsi kegiatan wajib diisi',
            'gambar_kegiatan.image' => 'Gambar kegiatan harus berupa file gambar',
            'gambar_kegiatan.mimes' => 'Gambar kegiatan harus berupa file: jpeg, png, jpg',
            'gambar_kegiatan.max' => 'Gambar kegiatan tidak boleh lebih dari 10MB',
        ]);

        try {

            if ($request->hasFile('gambar_kegiatan')) {
                // Validate file
                $gambar_kegiatan = $request->file('gambar_kegiatan');
                if (!$gambar_kegiatan->isValid()) {
                    throw new \Exception('File upload failed');
                }
        
                // Generate unique filename
                $timestamp = now()->timestamp;
                $extension = $gambar_kegiatan->getClientOriginalExtension();
                $gambar_kegiatan_name = "{$kode_kegiatan}_{$timestamp}.{$extension}";

                $gambar_kegiatan->move(public_path('uploads/kegiatan'), $gambar_kegiatan_name);
                $filepath= 'uploads/kegiatan/' . $gambar_kegiatan_name;

                $kegiatan->gambar_kegiatan = $filepath;
            }


            $kegiatan->kode_divisi = $request->kode_divisi;
            $kegiatan->nama_kegiatan = $request->nama_kegiatan;
            $kegiatan->tanggal_mulai = $request->tanggal_mulai;
            $kegiatan->lokasi_kegiatan = $request->lokasi_kegiatan;
            $kegiatan->penanggung_jawab = $request->penanggung_jawab;
            $kegiatan->deskripsi_kegiatan = $request->deskripsi_kegiatan;
            // Set tanggal_selesai when status is not "proses"
            if ($request->status_kegiatan !== 'proses') {
                $kegiatan->tanggal_selesai = now();
            }
            $kegiatan->status_kegiatan = $request->status_kegiatan;
            
            $kegiatan->save();

            return redirect()->route('manajemen-kegiatan')
                            ->with('success', 'Kegiatan berhasil diperbarui');
    
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Gagal memperbarui kegiatan: ' . $e->getMessage()])
                ->withInput();
        }

        try {
            if ($request->hasFile('gambar_kegiatan')) {
                // Validate file
                $gambar_kegiatan = $request->file('gambar_kegiatan');
                if (!$gambar_kegiatan->isValid()) {
                    throw new \Exception('File upload failed');
                }
        
                // Generate unique filename
                $timestamp = now()->timestamp;
                $extension = $gambar_kegiatan->getClientOriginalExtension();
                $gambar_kegiatan_name = "{$kode_kegiatan}_{$timestamp}.{$extension}";

                // Store file
                $path = $gambar_kegiatan->storeAs(
                    'public/kegiatan', 
                    $gambar_kegiatan_name
                );
        
                if (!$path) {
                    throw new \Exception('Failed to save image');
                }
        
                // Create symbolic link if not exists
                if (!file_exists(public_path('storage'))) {
                    \Artisan::call('storage:link');
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['gambar_kegiatan' => 'Gagal mengupload gambar: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function destroy($kode_kegiatan)
    {
        try {
            $kegiatan = Kegiatan::where('kode_kegiatan', $kode_kegiatan)->firstOrFail();
            $kegiatan->delete();

            return redirect()->route('manajemen-kegiatan')->with('success', 'Kegiatan berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('manajemen-kegiatan')->withErrors(['error' => 'Gagal menghapus kegiatan']);
        }
    }
}
