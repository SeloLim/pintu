@extends('layouts.app')

@section('title', 'Admin Profile')

@section('content')
<div class="flex-1 px-6 py-4">
    <!-- Grid of Reports -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Single Report Card -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-gray-300 h-40 flex items-center justify-center">
                <span class="text-gray-500">Preview Gambar PDF</span>
            </div>
            <div class="p-4 flex justify-between items-center">
                <h2 class="text-sm font-bold">Judul Laporan</h2>
                <button class="text-gray-500 text-xl">...</button>
            </div>
        </div>

        <!-- Duplicate the Report Card -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="bg-gray-300 h-40 flex items-center justify-center">
                <span class="text-gray-500">Preview Gambar PDF</span>
            </div>
            <div class="p-4 flex justify-between items-center">
                <h2 class="text-sm font-bold">Judul Laporan</h2>
                <button class="text-gray-500 text-xl">...</button>
            </div>
        </div>
        <!-- Tambahkan lebih banyak kartu laporan sesuai kebutuhan -->
    </div>
</div>
@endsection