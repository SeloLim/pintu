@extends('layouts.app')

@section('title', 'User Profile')

@section('content')    
<div class="flex h-full">
    <!-- Konten Utama -->
    <div class="flex-1 p-6 space-y-8">
        <!-- Header -->
        <header class="mb-6">
            <h1 class="text-2xl font-bold">Pengaturan</h1>
            <p class="text-sm text-gray-500">Kelola akun Anda</p>
        </header>

        <!-- Pengaturan Akun -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-bold mb-4">Pengaturan Akun</h2>
            
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('settings.update-password') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Username (disabled) -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Pengguna</label>
                    <input type="text" value="{{ auth()->user()->username }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50" disabled>
                </div>

                <!-- Current Password -->
                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700">Password Lama</label>
                    <input type="password" id="current_password" name="current_password" 
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                    @error('current_password')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- New Password -->
                <div>
                    <label for="new_password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                    <input type="password" id="new_password" name="new_password" 
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                    @error('new_password')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm New Password -->
                <div>
                    <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" 
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-our_red text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection