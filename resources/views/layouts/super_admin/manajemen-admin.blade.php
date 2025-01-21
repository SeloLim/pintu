@extends('layouts.app')

@section('title', 'Super Admin-Manajemen Admin')

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

<!-- Tabel -->
<div>
    <h1 class="text-center font-medium text-3xl mb-4">Manajemen Admin</h1>
    <div class="col-span-9 mx-auto w-1/2">
        <div class="bg-white shadow-md rounded-lg overflow-hidden p-4 w-full">
            <!-- Pencarian -->
            <div class="p-4 flex items-center space-x-4">
                <div class="relative w-full">
                    <!-- Search Form -->
                    <form action="{{ route('manajemen-admin') }}" method="GET" class="w-full">
                        @if(request('per_page'))
                            <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                        @endif
                        <input name="search" class="pl-10 px-4 py-2 border rounded-lg w-full focus:outline-none" 
                            placeholder="Masukan Username atau Kode Organisasi" 
                            type="text" 
                            value="{{ request('search') }}"/>
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </form>
                </div>
            </div>

            <!-- Tabel Data -->
            <table class="w-full border-collapse border border-gray-300">
                <thead class="bg-our_red text-white">
                    <tr>
                        <th class="border border-gray-300 py-2 px-4">No</th>
                        <th class="border border-gray-300 py-2 px-4">Username</th>
                        <th class="border border-gray-300 py-2 px-4">Kode Organisasi</th>
                        <th class="border border-gray-300 py-2 px-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $index => $admin)
                    <tr class="hover:bg-gray-100">
                        <td class="border border-gray-300 py-2 px-4 text-center">{{ $index + 1 }}</td>
                        <td class="border border-gray-300 py-2 px-4 text-center">{{ $admin->username}}</td>
                        <td class="border border-gray-300 py-2 px-4">{{ $admin->kode_organisasi }}</td>
                        <td class="border border-gray-300 py-2 px-4 text-center">
                            <div class="flex justify-center space-x-2">
                                <button x-data @click="$dispatch('open-modal', 'delete-modal-{{$admin->username}}')" class="bg-red-500 text-white px-2 py-1 rounded-lg hover:bg-red-600 transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @include('layouts.super_admin.modal-delete-admin')
                    @endforeach
                </tbody>
            </table>

            <!-- Standalone Pagination -->
            <div class="mt-4 flex justify-between items-center">
                <div>
                    <form action="{{ route('manajemen-admin') }}" method="GET" class="flex items-center">
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
                    {{ $admins->appends(request()->except('page'))->links() }}
                </div>

            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchForm = document.getElementById('search-form');

        // Submit search form when input changes
        searchForm.querySelector('input[name=search]').addEventListener('input', function () {
            searchForm.submit();
        });
    });
</script>
@endsection