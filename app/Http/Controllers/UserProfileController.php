<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserProfile;

class UserProfileController extends Controller
{
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $profile = UserProfile::where('user_username', $user->username)->first();

        $request->validate([
            'nim' => 'required|unique:user_profiles,nim,' . $profile->id,
            'nama_lengkap' => 'required',
            'kelas' => 'required',
            'program_studi' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'nomor_handphone' => 'required',
            'alamat' => 'required',
            'minat_hobi' => 'required',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ], [
            'nim.required' => 'NIM is required.',
            'nim.unique' => 'NIM must be unique.',
            'nama_lengkap.required' => 'Nama lengkap is required.',
            'kelas.required' => 'Kelas is required.',
            'program_studi.required' => 'Program studi is required.',
            'tempat_lahir.required' => 'Tempat lahir is required.',
            'tanggal_lahir.required' => 'Tanggal lahir is required.',
            'tanggal_lahir.date' => 'Tanggal lahir must be a valid date.',
            'nomor_handphone.required' => 'Nomor handphone is required.',
            'alamat.required' => 'Alamat is required.',
            'minat_hobi.required' => 'Minat hobi is required.',
            'profile_picture.image' => 'Profile picture must be an image.',
            'profile_picture.mimes' => 'Profile picture must be a file of type: jpeg, png, jpg.',
            'profile_picture.max' => 'Profile picture may not be greater than 10240 kilobytes.',
        ]);

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profile_pictures'), $filename);
            $profile->profile_picture = 'uploads/profile_pictures/' . $filename;
        }

        $profile->nim = $request->nim;
        $profile->nama_lengkap = $request->nama_lengkap;
        $profile->kelas = $request->kelas;
        $profile->program_studi = $request->program_studi;
        $profile->tempat_lahir = $request->tempat_lahir;
        $profile->tanggal_lahir = $request->tanggal_lahir;
        $profile->nomor_handphone = $request->nomor_handphone;
        $profile->alamat = $request->alamat;
        $profile->minat_hobi = $request->minat_hobi;
        $profile->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}
