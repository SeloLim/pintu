@extends('layouts.app')

@section('title', 'User Dashboard')

<style>
    .hide-scrollbar::-webkit-scrollbar {
        display: none; /* Sembunyikan scrollbar di browser berbasis Webkit (Chrome, Safari, dll.) */
    }
    .hide-scrollbar {
        -ms-overflow-style: none; /* Sembunyikan scrollbar di Internet Explorer */
        scrollbar-width: none; /* Sembunyikan scrollbar di Firefox */
    }
</style>

@section('content')
<div class="container mx-auto mb-6">
    <div class="flex justify-between items-center">
        <h2 class="text-xl font-bold">Kegiatan Terbaru</h2>
        <a href="{{ route('kegiatan-terbaru') }}" class="text-blue-500">View All</a>
    </div>
    <!-- Wrapper untuk Scroll -->
    <div class="overflow-x-auto hide-scrollbar px-auto mt-4">
        <!-- Container Card -->
        <div class="flex space-x-4 w-max">
        @forelse($kegiatanTerbaru as $kegiatan)
            <div @click="$dispatch('open-modal', { id: {{ $kegiatan->kode_kegiatan }} })" class="bg-white rounded-lg shadow-md overflow-hidden w-80 cursor-pointer hover:shadow-lg transition-shadow duration-300">
                <img src="{{ $kegiatan->gambar_kegiatan  ?? 'https://via.placeholder.com/150' }}" alt="Event Image" class="w-full h-48 object-cover">
                <div class="p-4">
                    <span class="text-sm text-green-700 bg-green-200 px-2 py-1 rounded">{{ $kegiatan->organisasi->kode_organisasi }}</span>
                    <span class="text-sm text-blue-700 bg-blue-200 px-2 py-1 rounded">{{ $kegiatan->divisi->alias_divisi }}</span>
                    <h3 class="text-lg font-semibold mt-3">{{ $kegiatan->nama_kegiatan }}</h3>
                    <p class="text-gray-600 text-sm">{{ Str::limit($kegiatan->deskripsi_kegiatan, 100) }}</p>
                </div>
            </div>
        @empty
            <div class="w-full text-center py-8">
                <p class="text-gray-500">Belum ada event terbaru</p>
            </div>
        @endforelse
        </div>
    </div>
</div>

<div class="container mx-auto mb-6">
    <div class="flex justify-between items-center">
        <h2 class="text-xl font-bold">Daftar Organisasi</h2>
        <a href="{{ route('daftar-organisasi') }}" class="text-blue-500">View All</a>
    </div>
    <!-- Wrapper untuk Scroll -->
    <div class="overflow-x-auto hide-scrollbar px-auto mt-4">
        <!-- Container Card -->
        <div class="flex space-x-4 w-max">
            @forelse($organisasi as $org)
                <div @click="$dispatch('open-modal', { id: {{ $org->kode_organisasi }} })" 
                    class="bg-white rounded-lg shadow-md overflow-hidden w-80 cursor-pointer hover:shadow-lg transition-shadow duration-300">
                    <img src="{{ $org->organisasi_picture ?? 'https://via.placeholder.com/150' }}" alt="Organization Image" class="w-full h-48 object-cover">
                    <div class="p-4 h-fit">
                        <span class="text-sm text-green-700 bg-green-200 px-2 py-1 rounded">{{ $org->kode_organisasi }}</span>
                        <span class="text-sm text-blue-700 bg-blue-200 px-2 py-1 rounded">{{ $org->tipe_organisasi }}</span>
                        <h3 class="text-lg font-semibold mt-3">{{ $org->nama_organisasi }}</h3>
                        <p class="text-gray-600 text-sm">{{ $org->deskripsi_organisasi ? Str::limit($org->deskripsi_organisasi, 100) : "Belum ada deskripsi" }}</p>
                    </div>
                </div>
            @empty
                <div class="w-full text-center py-8">
                    <p class="text-gray-500">Belum ada event terbaru</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<div class="container mx-auto mb-6">
    <div class="flex justify-between items-center">
        <h2 class="text-xl font-bold">Riwayat Kegiatan</h2>
        <a href="{{ route('riwayat-kegiatan') }}" class="text-blue-500">View All</a>
    </div>
    <!-- Wrapper untuk Scroll -->
    <div class="overflow-x-auto hide-scrollbar px-auto mt-4">
        <!-- Container Card -->
        <div class="flex space-x-4 w-max">
            @forelse($riwayatKegiatan as $riwayat)
                <div @click="$dispatch('open-modal', { id: {{ $riwayat->kode_kegiatan }} })" class="bg-white rounded-lg shadow-md overflow-hidden w-80 cursor-pointer hover:shadow-lg transition-shadow duration-300">
                    <img src="{{$riwayat->gambar_kegiatan  ?? 'https://via.placeholder.com/150' }}" alt="Event Image" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <span class="text-sm text-green-700 bg-green-200 px-2 py-1 rounded">{{ $riwayat->organisasi->kode_organisasi }}</span>
                        <span class="text-sm text-blue-700 bg-blue-200 px-2 py-1 rounded">{{ $riwayat->divisi->alias_divisi }}</span>
                        <h3 class="text-lg font-semibold mt-3">{{ $riwayat->nama_kegiatan }}</h3>
                        <p class="text-gray-600 text-sm">{{ Str::limit($riwayat->deskripsi_kegiatan, 100) }}</p>
                    </div>
                </div>
            @empty
                <div class="w-full text-center py-8">
                    <p class="text-gray-500">Belum ada event terbaru</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection