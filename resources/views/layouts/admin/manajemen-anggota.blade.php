@extends('layouts.app')

@section('title', 'Manajemen Anggota')

@section('content')

@if (session('alert'))
<div x-data="{ open: true }"
    x-show="open"
    x-init="setTimeout(() => open = false, 3000)"
    class="fixed top-4 right-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded z-50"
    role="alert">
    <span class="block sm:inline">{{ session('alert') }}</span>
    <button @click="open = false" class="absolute top-0 right-0 px-4 py-3">
        <span class="sr-only">Close</span>
        <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20">
            <path d="M6.293 6.293a1 1 0 011.414 0L10 8.586l2.293-2.293a1 1 0 111.414 1.414L11.414 10l2.293 2.293a1 1 0 01-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 01-1.414-1.414L8.586 10 6.293 7.707a1 1 0 010-1.414z"/>
        </svg>
    </button>
</div>
@endif

@if ($errors->any())
<div x-data="{ open: true }"
     x-show="open"
     x-init="setTimeout(() => open = false, 3000)"
     class="fixed top-4 right-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded z-50"
     role="alert">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button @click="show = false" class="absolute top-0 right-0 px-4 py-3">
        <span class="sr-only">Close</span>
        <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20">
            <path d="M6.293 6.293a1 1 0 011.414 0L10 8.586l2.293-2.293a1 1 0 111.414 1.414L11.414 10l2.293 2.293a1 1 0 01-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 01-1.414-1.414L8.586 10 6.293 7.707a1 1 0 010-1.414z"/>
        </svg>
    </button>
</div>
@endif

<h1 class="text-center font-medium text-3xl mb-4">Manajemen Anggota</h1>
<div class="grid grid-cols-12 gap-6">
    <!-- Filter -->
    <div class="col-span-3">
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-lg font-bold mb-4">Filter</h2>
            <form id="filter-form" action="{{ route('manajemen-anggota') }}" method="GET">
                <!-- Preserve existing parameters -->
                @if(request('search'))
                    <input type="hidden" name="search" value="{{ request('search') }}">
                @endif
                @if(request('per_page'))
                    <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                @endif

                <!-- Filter Divisi -->
                <div class="mb-4">
                    <h3 class="font-semibold text-sm mb-2">Filter Divisi</h3>
                    <label class="flex items-center mb-2">
                        <input type="radio" name="divisi" value="" class="form-radio text-our_red mr-2" {{ request('divisi') == '' ? 'checked' : '' }}>
                        <span class="text-sm">Semua Divisi</span>
                    </label>
                    @foreach($divisis as $divisi)
                        <label class="flex items-center mb-2">
                            <input type="radio" name="divisi" value="{{ $divisi->kode_divisi }}" class="form-radio text-our_red mr-2" {{ request('divisi') == $divisi->kode_divisi ? 'checked' : '' }}>
                            <span class="text-sm">{{ $divisi->nama_divisi }}</span>
                        </label>
                    @endforeach
                </div>

                <!-- Filter Jabatan -->
                <div class="mb-4">
                    <h3 class="font-semibold text-sm mb-2">Filter Jabatan</h3>
                    <label class="flex items-center mb-2">
                        <input type="radio" name="jabatan" value="" class="form-radio text-our_red mr-2" {{ request('jabatan') == '' ? 'checked' : '' }}>
                        <span class="text-sm">Semua Jabatan</span>
                    </label>
                    <label class="flex items-center mb-2">
                        <input type="radio" name="jabatan" value="Ketua" class="form-radio text-our_red mr-2" {{ request('jabatan') == 'Ketua' ? 'checked' : '' }}>
                        <span class="text-sm">Ketua</span>
                    </label>
                    <label class="flex items-center mb-2">
                        <input type="radio" name="jabatan" value="Wakil Ketua" class="form-radio text-our_red mr-2" {{ request('jabatan') == 'Wakil Ketua' ? 'checked' : '' }}>
                        <span class="text-sm">Wakil Ketua</span>
                    </label>
                    <label class="flex items-center mb-2">
                        <input type="radio" name="jabatan" value="Sekretaris" class="form-radio text-our_red mr-2" {{ request('jabatan') == 'Sekretaris' ? 'checked' : '' }}>
                        <span class="text-sm">Sekretaris</span>
                    </label>
                    <label class="flex items-center mb-2">
                        <input type="radio" name="jabatan" value="Bendahara" class="form-radio text-our_red mr-2" {{ request('jabatan') == 'Bendahara' ? 'checked' : '' }}>
                        <span class="text-sm">Bendahara</span>
                    </label>
                    <label class="flex items-center mb-2">
                        <input type="radio" name="jabatan" value="Anggota" class="form-radio text-our_red mr-2" {{ request('jabatan') == 'Anggota' ? 'checked' : '' }}>
                        <span class="text-sm">Anggota</span>
                    </label>
                </div>

                <!-- Status Keanggotaan Filter -->
                <div>
                    <h3 class="font-semibold text-sm mb-2">Filter Status Keanggotaan</h3>
                    <label class="flex items-center mb-2">
                        <input type="radio" name="status" value="" class="form-radio text-our_red mr-2" {{ request('status') == '' ? 'checked' : '' }}>
                        <span class="text-sm">Semua</span>
                    </label>
                    <label class="flex items-center mb-2">
                        <input type="radio" name="status" value="Aktif" class="form-radio text-our_red mr-2" {{ request('status') == 'Aktif' ? 'checked' : '' }}>
                        <span class="text-sm">Aktif</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="status" value="Non-Aktif" class="form-radio text-our_red mr-2" {{ request('status') == 'Non-Aktif' ? 'checked' : '' }}>
                        <span class="text-sm">Di Non-Aktifkan</span>
                    </label>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel -->
    <div class="col-span-9">
        <div class="bg-white shadow-md rounded-lg overflow-hidden p-4">
            <!-- Pencarian -->
            <div class="p-4 flex items-center space-x-4">
                <a x-data @click="$dispatch('open-modal', 'modal-tambah-anggota')" class="bg-our_red text-white px-4 py-2 rounded-lg hover:bg-red-500 w-fit cursor-pointer">
                    Tambah Anggota
                </a>
                <div class="relative w-1/2">
                    <!-- Search Form -->
                    <form action="{{ route('manajemen-anggota') }}" method="GET" class="w-full">
                        @if(request('status'))
                            <input type="hidden" name="status" value="{{ request('status') }}">
                        @endif
                        @if(request('per_page'))
                            <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                        @endif
                        <input name="search" class="pl-10 px-4 py-2 border rounded-lg w-full focus:outline-none" 
                            placeholder="Masukan Nama Anggota atau NIM" 
                            type="text" 
                            value="{{ request('search') }}"/>
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </form>
                </div>
                @include('layouts.admin.modal.tambah-anggota')
            </div>

            <!-- Tabel Data -->
            <table class="w-full border-collapse border border-gray-300">
                <thead class="bg-our_red text-white">
                    <tr>
                        <th class="border border-gray-300 py-2 px-4">No</th>
                        <th class="border border-gray-300 py-2 px-4">Kode Keanggotaan</th>
                        <th class="border border-gray-300 py-2 px-4">NIM</th>
                        <th class="border border-gray-300 py-2 px-4">Nama Lengkap</th>
                        <th class="border border-gray-300 py-2 px-4">Kelas</th>
                        <th class="border border-gray-300 py-2 px-4">Divisi</th>
                        <th class="border border-gray-300 py-2 px-4">Jabatan</th>
                        <th class="border border-gray-300 py-2 px-4">Status Keanggotaan</th>
                        <th class="border border-gray-300 py-2 px-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($anggotas as $index => $anggota)
                    
                    <tr class="hover:bg-gray-100">
                        <td class="border border-gray-300 py-2 px-4 text-center">{{ $index + 1 }}</td>
                        <td class="border border-gray-300 py-2 px-4 text-center">{{ $anggota->kode_anggota}}</td>
                        <td class="border border-gray-300 py-2 px-4 text-center">{{ $anggota->user_profile->nim }}</td>
                        <td class="border border-gray-300 py-2 px-4 text-center">{{ $anggota->user_profile->nama_lengkap}}</td>
                        <td class="border border-gray-300 py-2 px-4">{{$anggota->user_profile->kelas}}</td>
                        <td class="border border-gray-300 py-2 px-4 text-center">{{ $anggota->kode_divisi}}</td>
                        <td class="border border-gray-300 py-2 px-4 text-center">{{ $anggota->jabatan }}</td>
                        <td class="border border-gray-300 py-2 px-4 text-center">
                            <span 
                            class="
                            bg-{{ $anggota->status_keanggotaan === 'Aktif' ? 'green' : 'red' }}-200 
                            text-{{ $anggota->status_keanggotaan === 'Aktif' ? 'green' : 'red' }}-700 
                            px-2 py-1 rounded-full text-xs
                            ">
                                {{ $anggota->status_keanggotaan}}
                            </span>
                        </td>
                        <td class="border border-gray-300 py-2 px-4 text-center">
                            <div class="flex justify-center space-x-2">
                                <button x-data @click="$dispatch('open-modal', 'modal-edit-{{$anggota->username}}')" class="bg-yellow-500 text-white px-2 py-1 rounded-lg hover:bg-yellow-600 transition-colors">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button x-data @click="$dispatch('open-modal', 'modal-delete-{{$anggota->username}}')" class="bg-red-500 text-white px-2 py-1 rounded-lg hover:bg-red-600 transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- Modal Edit Anggota -->
                    @include('layouts.admin.modal.edit-anggota')
                    @include('layouts.admin.modal.delete-anggota')
                    @endforeach
                </tbody>
            </table>

            <!-- Standalone Pagination -->
            <div class="mt-4 flex justify-between items-center">
                <div>
                    <form action="{{ route('manajemen-anggota') }}" method="GET" class="flex items-center">
                        <!-- Preserve existing parameters -->
                        @if(request('status'))
                            <input type="hidden" name="status" value="{{ request('status') }}">
                        @endif
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        
                        Show 
                        <select name="per_page" class="border border-gray-300 rounded-md px-2 py-1 mx-2" onchange="this.form.submit()">
                            <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                            <option value="10" {{ request('per_page') == 10 || !request('per_page') ? 'selected' : '' }}>10</option>
                            <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                        </select>
                        entries
                    </form>
                </div>
                
                <div>
                    {{ $anggotas->appends(request()->except('page'))->links() }}
                </div>

            </div>
        </div>

        
    </div>
    
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterForm = document.getElementById('filter-form');
        const searchForm = document.getElementById('search-form');

        // Submit filter form when radio button changes
        filterForm.querySelectorAll('input[type=radio]').forEach(radio => {
            radio.addEventListener('change', function () {
                filterForm.submit();
            });
        });

        // Submit search form when input changes
        searchForm.querySelector('input[name=search]').addEventListener('input', function () {
            searchForm.submit();
        });
    });
</script>
@endsection