<div x-data="{ open: false }" @open-modal.window="if ($event.detail === 'modal-tambah-organisasi') open = true" x-cloak>
    <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50" @click="open = false">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/2" @click.stop>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Tambah Organisasi</h2>
                <button @click="open = false" class="text-gray-500 hover:text-gray-700">&times;</button>
            </div>
            <form action="{{ route('organisasi.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="kode_organisasi" class="block text-sm font-medium text-gray-700">Kode Organisasi</label>
                    <input type="text" id="kode_organisasi" name="kode_organisasi" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                </div>
                <div class="mb-4">
                    <label for="nama_organisasi" class="block text-sm font-medium text-gray-700">Nama Organisasi</label>
                    <input type="text" id="nama_organisasi" name="nama_organisasi" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                </div>
                <div class="mb-4">
                    <label for="tipe_organisasi" class="block text-sm font-medium text-gray-700">Tipe Organisasi</label>
                    <select id="tipe_organisasi" name="tipe_organisasi" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                        <option value="Ormawa">Ormawa</option>
                        <option value="UKM">UKM</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="status_organisasi" class="block text-sm font-medium text-gray-700">Status Organisasi</label>
                    <select id="status_organisasi" name="status_organisasi" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                        <option value="Aktif">Aktif</option>
                        <option value="Non-Aktif">Non-Aktif</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="tahun_berdiri" class="block text-sm font-medium text-gray-700">Tahun Berdiri</label>
                    <select id="tahun_berdiri" name="tahun_berdiri" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                        @for ($year = date('Y'); $year >= 2020; $year--)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                </div>

                <div class="border-t-2 border-gray-300 border-solid">
                    <div class="px-4 mt-4">
                        <h2 class="text-xl font-bold mb-4">Akun Admin</h2>
                        <div class="flex items-center space-x-2">
                            <div class="mb-4">
                                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                                <input type="text" id="username" name="username" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                            </div>
                            
                            <div class="mb-4">
                                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                <input type="password" id="password" name="password" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                            </div>
                        </div>
                    </div>
                    
                </div>

                <!-- Add other fields as necessary -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

