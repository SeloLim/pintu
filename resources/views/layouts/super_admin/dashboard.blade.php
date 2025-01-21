@extends('layouts.app')

@section('title', 'Super Admin Dashboard')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Example Card -->
    <div class="bg-white rounded-lg shadow-md p-4 flex items-center">
        <div class="bg-pink-500 text-white rounded-full p-3">
            <span class="material-icons">bar_chart</span>
        </div>
        <div class="ml-4">
            <h2 class="text-sm font-bold">Total Kegiatan</h2>
            <p class="text-xl font-bold">100</p>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow-md p-4 flex items-center">
        <div class="bg-pink-500 text-white rounded-full p-3">
            <span class="material-icons">bar_chart</span>
        </div>
        <div class="ml-4">
            <h2 class="text-sm font-bold">Jumlah Anggota</h2>
            <p class="text-xl font-bold">224</p>
        </div>
    </div>
    <!-- Tambahkan lebih banyak card sesuai kebutuhan -->
    <!-- Duplikasi contoh card di atas -->
</div>
@endsection
