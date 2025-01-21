@extends('layouts.app')

@section('title', 'Daftar Organisasi')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
    @forelse($organisasis as $organisasi)
        <div class="bg-white shadow-md rounded-lg overflow-hidden cursor-pointer hover:shadow-lg transition-shadow duration-300" 
             @click="$dispatch('open-modal', { id: '{{ $organisasi->kode_organisasi }}' })">
            <img src="{{ $organisasi->organisasi_picture ?? 'https://via.placeholder.com/150' }}" 
                 alt="{{ $organisasi->nama_organisasi }}" 
                 class="w-52 h-52 object-cover mx-auto">
            <div class="p-4">
                <div class="flex gap-2 mb-2">
                    <span class="text-sm text-green-700 bg-green-200 px-2 py-1 rounded">
                        {{ $organisasi->kode_organisasi }}
                    </span>
                    <span class="text-sm text-blue-700 bg-blue-200 px-2 py-1 rounded">
                        {{ $organisasi->tipe_organisasi }}
                    </span>
                </div>
                <h3 class="font-bold text-lg">{{ $organisasi->nama_organisasi }}</h3>
                <p class="text-sm text-gray-600">
                    {{ $organisasi->deskripsi_organisasi ? Str::limit($organisasi->deskripsi_organisasi, 100) : "Belum ada deskripsi" }}
                </p>
            </div>
        </div>
    @empty
        <div class="col-span-full text-center py-8">
            <p class="text-gray-500">Belum ada organisasi terdaftar</p>
        </div>
    @endforelse
</div>

<div class="mt-6">
    {{ $organisasis->links() }}
</div>
@endsection