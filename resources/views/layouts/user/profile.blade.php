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
        <!-- Header -->
        <header class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold">User Profile</h1>
        </header>

        <!-- Informasi Profil -->
        <div class="bg-white shadow-md rounded-lg p-6 space-y-6">
            <!-- Foto Profil -->
            <div class="flex items-center space-x-6">
                <div class="w-32 h-32 rounded-full overflow-hidden border-2 border-gray-300">
                    <img src="{{ $profile->profile_picture ?? 'https://via.placeholder.com/150' }}" alt="Foto Profil" class="w-full h-full object-cover">
                </div>
                <div>
                    <h2 class="text-lg font-bold">{{ $profile->nama_lengkap ?? '' }}</h2>
                </div>
            </div>

            <!-- Informasi Akun -->
            <div class="mt-4 space-y-4">
                <!-- NIM -->
                <div class="flex justify-between items-center border-b pb-2">
                    <p class="text-sm font-medium">NIM</p>
                    <p class="text-sm font-bold">{{ $profile->nim ?? '' }}</p>
                
                </div>
                <!-- Kelas -->
                <div class="flex justify-between items-center border-b pb-2">
                    <p class="text-sm font-medium">Kelas</p>
                    <p class="text-sm font-bold">{{ $profile->kelas ?? '' }}</p>
                </div>
                <!-- Program Studi -->
                <div class="flex justify-between items-center border-b pb-2">
                    <p class="text-sm font-medium">Program Studi</p>
                    <p class="text-sm font-bold">{{ $profile->program_studi ?? '' }}</p>
                </div>
                <!-- Tempat, tanggal lahir -->
                <div class="flex justify-between items-center border-b pb-2">
                    <p class="text-sm font-medium">Tempat dan Tanggal Lahir</p>
                    <p class="text-sm font-bold">{{ $profile->tempat_lahir ?? '' }}{{ isset($profile->tanggal_lahir) ? ', '.\Carbon\Carbon::parse($profile->tanggal_lahir)->locale('id')->translatedFormat('d F Y') : '' }}</p>
                </div>
                <!-- Nomor Handphone -->
                <div class="flex justify-between items-center border-b pb-2">
                    <p class="text-sm font-medium">Nomor Handphone</p>
                    <p class="text-sm font-bold">{{ $profile->nomor_handphone ?? '' }}</p>
                </div>
                <!-- Alamat -->
                <div class="flex justify-between items-center border-b pb-2">
                    <p class="text-sm font-medium">Alamat</p>
                    <p class="text-sm font-bold">{{ $profile->alamat ?? '' }}</p>
                </div>
                <!-- Minat atau Hobi -->
                <div class="flex justify-between items-center border-b pb-2">
                    <p class="text-sm font-medium">Minat atau Hobi</p>
                    <p class="text-sm font-bold">{{ $profile->minat_hobi ?? '' }}</p>
                </div>
            </div>

            

            <!-- Tombol Edit -->
            <div class="flex justify-end mt-4">
                <a href="{{ route('edit-profile') }}" class="bg-our_red text-white px-4 py-2 rounded-lg hover:bg-red-500">
                    Edit
                </a>
            </div>
        </div>
    </div>
</div>
@endsection