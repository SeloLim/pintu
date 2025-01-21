@php
    $user = auth()->user();
    $name = $user->username;
    $role = $user->role;
    $kode_organisasi = $user->kode_organisasi;
    $organisasi = \App\Models\Organisasi::where('kode_organisasi', $kode_organisasi)->first();
@endphp


@extends('layouts.app')

@section('title', 'Admin Profile')

@section('content')
<div class="flex h-full">
    <div class="flex-1 p-6">
        <header class="mb-6">
            <h1 class="text-2xl font-bold">Edit Profil</h1>
            <p class="text-sm text-gray-500">Perbarui informasi profil Anda</p>
        </header>

        <!-- Form Edit -->
        <div class="bg-white shadow-md rounded-lg p-6 space-y-6">
            <!-- Form Informasi -->
            <form action="{{ route('admin-profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
                
                <!-- Foto Profil -->
                <div class="flex justify-center">
                    <div class="relative">
                        <div class="w-64 h-64 rounded-full overflow-hidden border-2 border-gray-300">
                            <img id="previewImage" src="{{ $organisasi->organisasi_picture ?? 'https://via.placeholder.com/150' }}" alt="Foto Profil" class="w-full h-full object-cover">
                        </div>
                        <!-- Tombol Ubah Foto -->
                        <label for="organisasi_picture" class="absolute bottom-2 right-2 bg-blue-500 text-white rounded-full w-fit p-2 cursor-pointer hover:bg-blue-600">
                            <span class="material-icons text-sm">camera_alt</span>
                        </label>
                        <input type="file" id="organisasi_picture" name="organisasi_picture" accept="image/png, image/jpeg, image/jpg" class="hidden" onchange="previewFile()">
                        <p class="text-sm text-gray-500 mt-4 text-center">Maksimal ukuran file 10MB</p>
                    </div>
                </div>
                

                <div>
                    <label for="kode_organisasi" class="block text-sm font-medium text-gray-700">Kode Organisasi</label>
                    <input type="text" id="kode_organisasi" name="kode_organisasi" value="{{ $organisasi->kode_organisasi ?? '' }}"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500" disabled>
                </div>

                <div>
                    <label for="nama_organisasi" class="block text-sm font-medium text-gray-700">Nama Organisasi</label>
                    <input type="text" id="nama_organisasi" name="nama_organisasi" value="{{ $organisasi->nama_organisasi ?? '' }}"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500" disabled>
                </div>
                
                <div>
                    <label for="tipe_organisasi" class="block text-sm font-medium text-gray-700">Tipe Organisasi</label>
                    <input type="text" id="tipe_organisasi" name="tipe_organisasi" value="{{ $organisasi->tipe_organisasi ?? '' }}"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500" disabled>
                </div>

                <div>
                    <label for="status_organisasi" class="block text-sm font-medium text-gray-700">Status Organisasi</label>
                    <input type="text" id="status_organisasi" name="status_organisasi" value="{{ $organisasi->status_organisasi ?? '' }}"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500" disabled>
                </div>

                <div>
                    <label for="tahun_berdiri" class="block text-sm font-medium text-gray-700">Tahun Berdiri</label>
                    <input type="text" id="tahun_berdiri" name="tahun_berdiri" value="{{ $organisasi->tahun_berdiri ?? '' }}"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500" disabled>
                </div>

                <div>
                    <label for="email_organisasi" class="block text-sm font-medium text-gray-700">Email Organisasi</label>
                    <input type="email" id="email_organisasi" name="email_organisasi" value="{{ $organisasi->email_organisasi ?? '' }}"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                </div>

                <div>
                    <label for="telephone_organisasi" class="block text-sm font-medium text-gray-700">Telephone Organisasi</label>
                    <input type="text" id="telephone_organisasi" name="telephone_organisasi" value="{{ $organisasi->telephone_organisasi ?? '' }}"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                </div>
            
                <div>
                    <label for="deskripsi_organisasi" class="block text-sm font-medium text-gray-700">Deskripsi Organisasi</label>
                    <textarea id="deskripsi_organisasi" name="deskripsi_organisasi" rows="3"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">{{ $organisasi->deskripsi_organisasi ?? '' }}</textarea>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Tombol Simpan -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewFile() {
    const preview = document.getElementById('previewImage');
    const file = document.querySelector('input[type=file]').files[0];
    const reader = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
    }

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = "{{ $profile->profile_picture ?? 'https://via.placeholder.com/150' }}";
    }
}
</script>

@endsection