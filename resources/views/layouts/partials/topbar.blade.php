@php
    $user = auth()->user();
    $name = $user->username;
    $role = $user->role;
    $profile = \App\Models\UserProfile::where('user_username', $user->username)->first(); 
@endphp

<header class="flex items-center justify-between p-4 bg-white shadow-md ">
    <div class="flex items-center space-x-4">
        <button class="text-gray-600 text-2xl">
        <i class="fas fa-bars"></i>
        </button>
    </div>
    <div class="flex items-center space-x-6">
        <div class="relative">
        @if($role === 'user')
            </div>
                <a href="{{ route('profile') }}" class="flex items-center space-x-2">
                    <img alt="User profile picture" class="w-10 h-10 rounded-full" height="40" src="{{ $profile->profile_picture ?? 'https://via.placeholder.com/150' }}"
                    width="40"/>
                    <div>
                        <div class="font-semibold">
                            {{ $profile->nama_lengkap ?? 'user'}}
                        </div>
                        <div class="text-sm text-gray-500">
                            {{ $role }}
                        </div>
                    </div>
                </a>
            </div>
        @elseif($role === 'super_admin')
            </div>
                <div class="flex items-center space-x-2">
                    <img alt="User profile picture" class="w-10 h-10 rounded-full" height="40" src="https://storage.googleapis.com/a1aa/image/Mx5kUleiOOwJC6eCh2qlqocy6Wey7Ex14dMAFT8w1XgRANfPB.jpg" width="40"/>
                    <div>
                        <div class="font-semibold">
                            {{ $name }}
                        </div>
                        <div class="text-sm text-gray-500">
                            {{ $role }}
                        </div>
                    </div>
                </div>
            </div>
        @elseif($role === 'admin')
            </div>
                <a href="{{ route('profile') }}" class="flex items-center space-x-2">
                    <img alt="Admin profile picture" class="w-10 h-10 rounded-full" height="40" src="{{ $organisasi->organisasi_picture ?? 'https://via.placeholder.com/150' }}"
                    width="40"/>
                    <div>
                        <div class="font-semibold">
                            {{ $name}}
                        </div>
                        <div class="text-sm text-gray-500">
                            {{ $role }}
                        </div>
                    </div>
                </a>
            </div>
        @endif
</header>