@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Single Card -->
    <div class="bg-white shadow-md rounded-lg p-4 flex items-center">
        <div class="bg-pink-500 text-white rounded-full w-12 h-12 flex items-center justify-center">
            📊
        </div>
        <div class="ml-4">
            <h2 class="text-gray-600 text-sm">Total Kegiatan</h2>
            <p class="text-lg font-bold">100</p>
        </div>
        <div class="ml-auto text-right">
            <h2 class="text-gray-600 text-sm">Jumlah Anggota</h2>
            <p class="text-lg font-bold">224</p>
        </div>
    </div>

    <!-- Repeat Cards -->
    <div class="bg-white shadow-md rounded-lg p-4 flex items-center">
        <div class="bg-pink-500 text-white rounded-full w-12 h-12 flex items-center justify-center">
            📊
        </div>
        <div class="ml-4">
            <h2 class="text-gray-600 text-sm">Total Kegiatan</h2>
            <p class="text-lg font-bold">100</p>
        </div>
        <div class="ml-auto text-right">
            <h2 class="text-gray-600 text-sm">Jumlah Anggota</h2>
            <p class="text-lg font-bold">224</p>
        </div>
    </div>

    <!-- Tambahkan lebih banyak kartu sesuai kebutuhan -->
</div>
@endsection
