<div x-data="{ open: false }" @open-modal.window="if ($event.detail === 'modal-tambah-divisi') open = true" x-cloak>
    <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50" @click="open = false">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/2" @click.stop>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Tambah Divisi</h2>
                <button @click="open = false" class="text-gray-500 hover:text-gray-700">&times;</button>
            </div>
            <form action="{{route('divisi.store')}}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="nama_divisi" class="block text-sm font-medium text-gray-700">Nama Divisi</label>
                    <input type="text" id="nama_divisi" name="nama_divisi" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                </div>
                <div class="mb-4">
                    <label for="alias_divisi" class="block text-sm font-medium text-gray-700">Alias Divisi</label>
                    <input type="text" id="alias_divisi" name="alias_divisi" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                </div>
                <div class="mb-4">
                    <label for="status_divisi" class="block text-sm font-medium text-gray-700">Status Divisi</label>
                    <select id="status_divisi" name="status_divisi" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                        <option value="Aktif">Aktif</option>
                        <option value="Non-Aktif">Non-Aktif</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="deskripsi_divisi" class="block text-sm font-medium text-gray-700">Deskripsi Divisi</label>
                    <textarea id="deskripsi_divisi" name="deskripsi_divisi" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500"></textarea>
                </div>

                <!-- Add other fields as necessary -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

