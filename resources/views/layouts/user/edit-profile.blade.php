@php
    $user = auth()->user();
    $name = $user->username;
    $role = $user->role;
    $profile = \App\Models\UserProfile::where('user_username', $user->username)->first();
@endphp

@extends('layouts.app')

@section('title', 'User Profile')

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
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
                
                <!-- Foto Profil -->
                <div class="flex justify-center">
                    <div class="relative">
                        <div class="w-64 h-64 rounded-full overflow-hidden border-2 border-gray-300">
                            <img id="previewImage" src="{{ $profile->profile_picture ?? 'https://via.placeholder.com/150' }}" alt="Foto Profil" class="w-full h-full object-cover">
                        </div>
                        <!-- Tombol Ubah Foto -->
                        <label for="profile_picture" class="absolute bottom-2 right-2 bg-blue-500 text-white rounded-full w-fit p-2 cursor-pointer hover:bg-blue-600">
                            <span class="material-icons text-sm">camera_alt</span>
                        </label>
                        <input type="file" id="profile_picture" name="profile_picture" accept="image/png, image/jpeg, image/jpg" class="hidden" onchange="previewFile()">
                        <p class="text-sm text-gray-500 mt-4 text-center">Maksimal ukuran file 10MB</p>
                    </div>
                </div>
                

                <!-- Nama Lengkap -->
                <div>
                    <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ $profile->nama_lengkap ?? '' }}"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                </div>
                
                <!-- NIM -->
                <div>
                    <label for="nim" class="block text-sm font-medium text-gray-700">NIM</label>
                    <input type="text" id="nim" name="nim" value="{{ $profile->nim ?? '' }}"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                </div>

                <!-- Kelas -->
                <div>
                    <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
                    <input type="text" id="kelas" name="kelas" value="{{ $profile->kelas ?? '' }}"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                </div>

                <!-- Program Studi -->
                <div>
                    <label for="program_studi" class="block text-sm font-medium text-gray-700">Program Studi</label>
                    <input type="text" id="program_studi" name="program_studi" value="{{ $profile->program_studi ?? '' }}"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                </div>

                <!-- Tempat Lahir -->
                <div>
                    <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                    <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ $profile->tempat_lahir ?? '' }}"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                </div>

                <!-- Tanggal Lahir -->
                <div>
                    <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ $profile->tanggal_lahir ?? '' }}"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                </div>

                <!-- Nomor Handphone -->
                <div>
                    <label for="nomor_handphone" class="block text-sm font-medium text-gray-700">Nomor Handphone</label>
                    <input type="text" id="nomor_handphone" name="nomor_handphone" value="{{ $profile->nomor_handphone ?? '' }}"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                </div>

                <!-- Alamat -->
                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat Domisili</label>
                    <textarea id="alamat" name="alamat" rows="3"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">{{ $profile->alamat ?? '' }}</textarea>
                </div>

                <!-- Minat atau Hobi -->
                <div>
                    <label for="minat_hobi" class="block text-sm font-medium text-gray-700">Minat atau Hobi</label>
                    <textarea id="minat_hobi" name="minat_hobi" rows="3"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">{{ $profile->minat_hobi ?? '' }}</textarea>
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