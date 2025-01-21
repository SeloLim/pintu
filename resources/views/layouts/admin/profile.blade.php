@php
    $user = auth()->user();
    $name = $user->username;
    $role = $user->role;
    $kode_organisasi = $user->kode_organisasi;
    $organisasi = \App\Models\Organisasi::where('kode_organisasi', $kode_organisasi)->first();
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
                    <img src="{{ $organisasi->organisasi_picture ?? 'https://via.placeholder.com/150' }}" alt="Foto Profil" class="w-full h-full object-cover">
                </div>
                <div>
                    <h2 class="text-lg font-bold">{{ $name ?? '' }}</h2>
                </div>
            </div>

            <!-- Informasi Akun -->
            <div class="mt-4 space-y-4">
                <div class="flex justify-between items-center border-b pb-2">
                    <p class="text-sm font-medium">Kode Organisasi</p>
                    <p class="text-sm font-bold">{{ $organisasi->kode_organisasi ?? '' }}</p>
                </div>
                <div class="flex justify-between items-center border-b pb-2">
                    <p class="text-sm font-medium">Nama Organisasi</p>
                    <p class="text-sm font-bold">{{ $organisasi->nama_organisasi ?? '' }}</p>
                </div>
                <div class="flex justify-between items-center border-b pb-2">
                    <p class="text-sm font-medium">Tipe Organisasi</p>
                    <p class="text-sm font-bold">{{ $organisasi->tipe_organisasi ?? '' }}</p>
                </div>
                <div class="flex justify-between items-center border-b pb-2">
                    <p class="text-sm font-medium">Status Organisasi</p>
                    <p class="text-sm font-bold">{{ $organisasi->status_organisasi ?? '' }}</p>
                </div>
                <div class="flex justify-between items-center border-b pb-2">
                    <p class="text-sm font-medium">Tahun Berdiri</p>
                    <p class="text-sm font-bold">{{ $organisasi->tahun_berdiri ?? '' }}</p>
                </div>
                <div class="flex justify-between items-center border-b pb-2">
                    <p class="text-sm font-medium">Email Organisasi</p>
                    <p class="text-sm font-bold">{{ $organisasi->email_organisasi ?? '' }}</p>
                </div>
                <div class="flex justify-between items-center border-b pb-2">
                    <p class="text-sm font-medium">Telephone Organisasi</p>
                    <p class="text-sm font-bold">{{ $organisasi->telephone_organisasi ?? '' }}</p>
                </div>
                <div class="flex justify-between items-center border-b pb-2">
                    <p class="text-sm font-medium">Deskripsi Organisasi</p>
                    <span class="text-sm font-bold max-w-96 text-justify">{{ $organisasi->deskripsi_organisasi ?? '' }}</span>
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