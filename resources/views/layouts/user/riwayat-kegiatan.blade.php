@extends('layouts.app')

@section('title', 'Riwayat Kegiatan')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    @forelse($kegiatans as $kegiatan)
        <div class="bg-white shadow-md rounded-lg overflow-hidden cursor-pointer " @click="$dispatch('open-modal', { id: {{ $kegiatan->kode_kegiatan }} })" >
            <img src="{{$kegiatan->gambar_kegiatan}}" 
                 alt="Event Image" 
                 class="w-full h-40 object-cover">
            <div class="p-4">
                <span class="text-sm px-2 py-1 rounded-full
                    {{ $kegiatan->status_kegiatan === 'Terlaksana' ? 'bg-green-200 text-green-700' : 
                       ($kegiatan->status_kegiatan === 'Proses' ? 'bg-yellow-200 text-yellow-700' : 
                       'bg-red-200 text-red-700') }}">
                    {{ $kegiatan->status_kegiatan }}
                </span>
                <h3 class="mt-2 font-bold">{{ $kegiatan->nama_kegiatan }}</h3>
                <p class="text-sm text-gray-600">Tanggal Mulai: {{ $kegiatan->tanggal_mulai }}</p>
                <p class="text-sm text-gray-600">{{ Str::limit($kegiatan->deskripsi_kegiatan, 100) }}</p>
            </div>
        </div>
    @empty
        <div class="col-span-full text-center py-8">
            <p class="text-gray-500">Belum ada riwayat kegiatan</p>
        </div>
    @endforelse
</div>
@endsection