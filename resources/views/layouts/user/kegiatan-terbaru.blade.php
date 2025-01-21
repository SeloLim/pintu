@extends('layouts.app')

@section('title', 'Kegiatan Terbaru')

@section('content')
@if($latestKegiatan->isNotEmpty())
    <!-- Large Highlighted Card -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden flex mb-6">
        <div class="flex w-1/2 items-center justify-center">
            <img src="{{ $latestKegiatan[0]->gambar_kegiatan ?? 'https://placehold.co/600x300.png?text=No%20Image' }}" 
             alt="Highlight Image" 
             class="w-fit h-96 object-cover ">
        </div>
        
        <div class="p-6 w-1/2">
            <div class="flex space-x-2 mb-4">
                <span class="bg-green-200 text-green-700 px-2 py-1 text-sm rounded">{{ $latestKegiatan[0]->organisasi->nama_organisasi }}</span>
                <span class="bg-blue-200 text-blue-700 px-2 py-1 text-sm rounded">{{ $latestKegiatan[0]->divisi->nama_divisi }}</span>
            </div>
            <h3 class="font-bold text-lg">{{ $latestKegiatan[0]->nama_kegiatan }}</h3>
            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($latestKegiatan[0]->deskripsi_kegiatan, 150) }}</p>
            <button @click="$dispatch('open-modal', { id: '{{ $latestKegiatan[0]->kode_kegiatan }}' })" 
                    class="text-red-500 font-bold">
                Explore
            </button>
        </div>
    </div>

    @if($latestKegiatan->count() > 1)
    <!-- Smaller Cards (2 Columns) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @for($i = 1; $i < min(3, $latestKegiatan->count()); $i++)
        <div class="bg-white rounded-lg shadow-md overflow-hidden flex">
            @if($i % 2 == 1)
                <div class="p-6 w-1/2">
                    <div class="flex space-x-2 mb-4">
                        <span class="bg-blue-200 text-blue-700 px-2 py-1 text-sm rounded">{{ $latestKegiatan[$i]->organisasi->nama_organisasi }}</span>
                        <span class="bg-blue-200 text-blue-700 px-2 py-1 text-sm rounded">{{ $latestKegiatan[$i]->divisi->nama_divisi }}</span>
                    </div>
                    <h3 class="font-bold text-lg">{{ $latestKegiatan[$i]->nama_kegiatan }}</h3>
                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($latestKegiatan[$i]->deskripsi_kegiatan, 100) }}</p>
                    <button @click="$dispatch('open-modal', { id: '{{ $latestKegiatan[$i]->kode_kegiatan }}' })" 
                            class="text-red-500 font-bold">
                        Explore
                    </button>
                </div>
                <img src="{{ $latestKegiatan[$i]->gambar_kegiatan ?? 'https://placehold.co/300x200.png?text=No%20Image' }}" 
                     alt="Event Image" 
                     class="w-1/2 object-cover">
            @else
                <img src="{{ $latestKegiatan[$i]->gambar_kegiatan ?? 'https://placehold.co/300x200.png?text=No%20Image' }}" 
                     alt="Event Image" 
                     class="w-1/2 object-cover">
                <div class="p-6 w-1/2">
                    <div class="flex space-x-2 mb-4">
                        <span class="bg-blue-200 text-blue-700 px-2 py-1 text-sm rounded">{{ $latestKegiatan[$i]->organisasi->nama_organisasi }}</span>
                        <span class="bg-blue-200 text-blue-700 px-2 py-1 text-sm rounded">{{ $latestKegiatan[$i]->divisi->nama_divisi }}</span>
                    </div>
                    <h3 class="font-bold text-lg">{{ $latestKegiatan[$i]->nama_kegiatan }}</h3>
                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($latestKegiatan[$i]->deskripsi_kegiatan, 100) }}</p>
                    <button @click="$dispatch('open-modal', { id: '{{ $latestKegiatan[$i]->kode_kegiatan }}' })" 
                            class="text-red-500 font-bold">
                        Explore
                    </button>
                </div>
            @endif
        </div>
        @endfor
    </div>
    @endif
@else
    <div class="text-center py-8">
        <p class="text-gray-500">Belum ada kegiatan terbaru</p>
    </div>
@endif
@endsection