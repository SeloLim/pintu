@php
    $user = auth()->user();
    $name = $user->name;
    $role = $user->role;
@endphp

<aside class="w-fit bg-white shadow-md h-full">   
    <div class="p-6 text-center font-bold text-lg border-b-2 border-gray-200">
        <a href="{{ route('dashboard') }}" class="text-black">
            PINTU APP LOGO
        </a>
    </div>
    <nav class="mt-4">
        <ul class="space-y-4">
            @if ($role === 'admin')
                <li><a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-our_red hover:text-white {{ Route::currentRouteName() == 'dashboard' ? 'bg-our_red text-white' : '' }}">
                    <span class="material-icons mr-3">dashboard</span>
                    Dashboard
                    </a></li>
                <li><a href="{{ route('manajemen-divisi') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-our_red hover:text-white {{ Route::currentRouteName() == 'manajemen-divisi' ? 'bg-our_red text-white' : '' }}">
                    <span class="material-icons mr-3">group</span>
                    Manajemen Divisi
                    </a></li>
                <li><a href="{{ route('manajemen-anggota') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-our_red hover:text-white {{ Route::currentRouteName() == 'manajemen-anggota' ? 'bg-our_red text-white' : '' }}">
                    <span class="material-icons mr-3">group</span>
                    Manajemen Anggota
                    </a></li>
                <li> <a href="{{ route('manajemen-kegiatan') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-our_red hover:text-white {{ Route::currentRouteName() == 'manajemen-kegiatan' ? 'bg-our_red text-white' : '' }}">
                    <span class="material-icons mr-3">event</span>
                    Manajemen Kegiatan
                    </a></li>
            
            <!-- ------------------------------------------------------------------------------------------------------------------------ -->
            @elseif ($role === 'super_admin')
                <li><a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-our_red hover:text-white {{ Route::currentRouteName() == 'dashboard' ? 'bg-our_red text-white' : '' }}">
                    <span class="material-icons mr-3">dashboard</span>
                    Dashboard
                    </a></li>
                <li><a href="{{ route('manajemen-organisasi') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-our_red hover:text-white {{ Route::currentRouteName() == 'manajemen-organisasi' ? 'bg-our_red text-white' : '' }}">
                    <span class="material-icons mr-3">view_list</span>
                    Manajemen Organisasi
                    </a></li>
                <li> <a href="{{ route('manajemen-admin') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-our_red hover:text-white {{ Route::currentRouteName() == 'manajemen-admin' ? 'bg-our_red text-white' : '' }}">
                    <span class="material-icons mr-3">group</span>
                    Manajemen Admin
                    </a></li>


            <!-- ------------------------------------------------------------------------------------------------------------------------ -->
            @elseif ($role === 'user')
                <li><a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-our_red hover:text-white {{ Route::currentRouteName() == 'dashboard' ? 'bg-our_red text-white' : '' }}">
                    <span class="material-icons mr-3">dashboard</span>
                    Dashboard
                    </a></li>
                <li><a href="{{ route('status-keanggotaan') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-our_red hover:text-white {{ Route::currentRouteName() == 'status-keanggotaan' ? 'bg-our_red text-white' : '' }}">
                    <span class="material-icons mr-3">how_to_reg</span>
                    Status Keanggotaan
                    </a></li>
                <li> <a href="{{ route('riwayat-kegiatan') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-our_red hover:text-white {{ Route::currentRouteName() == 'riwayat-kegiatan' ? 'bg-our_red text-white' : '' }}">
                    <span class="material-icons mr-3">history</span>
                    Riwayat Kegiatan
                    </a></li>
                <li><a href="{{ route('daftar-organisasi') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-our_red hover:text-white {{ Route::currentRouteName() == 'daftar-organisasi' ? 'bg-our_red text-white' : '' }}">
                    <span class="material-icons mr-3">assignment</span>
                    Daftar Organisasi
                    </a></li>
                <li><a href="{{ route('kegiatan-terbaru') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-our_red hover:text-white {{ Route::currentRouteName() == 'kegiatan-terbaru' ? 'bg-our_red text-white' : '' }}">
                    <span class="material-icons mr-3">event</span>
                    Kegiatan Terbaru
                    </a></li>
            @endif
        </ul>
        <div class="mt-4 border-t border-gray-200">
            <a href="{{ route('settings') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-our_red hover:text-white mt-4 {{ Route::currentRouteName() == 'settings' ? 'bg-our_red text-white' : '' }}">
                <span class="material-icons mr-3">settings</span>
                Settings
            </a>
            <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center px-6 py-3 text-gray-700 hover:bg-our_red hover:text-white mt-4">
                    <span class="material-icons mr-3">logout</span>
                    Logout
                </button>
            </form>
        </div>
    </nav>
</aside>
