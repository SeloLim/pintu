<div x-data="{ open: false }" @open-modal.window="if ($event.detail === 'modal-tambah-anggota') open = true" x-cloak>
    <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50" @click="open = false">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/2" @click.stop>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Tambah Anggota</h2>
                <button @click="open = false" class="text-gray-500 hover:text-gray-700">&times;</button>
            </div>
            <form action="{{route('anggota.store')}}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="nim" class="block text-sm font-medium text-gray-700">NIM</label>
                    <input type="text" 
                        id="nim" 
                        name="nim" 
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500"
                        @input="
                        $el.value = $el.value.toUpperCase();
                        document.getElementById('username').value = $el.value.toLowerCase();
                        ">
                    <input type="hidden" 
                        id="username" 
                        name="username">
                </div>

                <div class="mb-4">
                    <label for="kode_divisi" class="block text-sm font-medium text-gray-700">Kode Divisi</label>
                    <select id="kode_divisi" name="kode_divisi" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                        <option value="">Pilih Divisi</option>
                        @foreach($divisis as $divisi)
                            <option value="{{ $divisi->kode_divisi }}">{{ $divisi->nama_divisi }} ({{ $divisi->kode_divisi }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="jabatan" class="block text-sm font-medium text-gray-700">Jabatan</label>
                    <select id="jabatan" name="jabatan" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                        <option value="">Pilih Jabatan</option>
                        <option value="Ketua">Ketua</option>
                        <option value="Wakil Ketua">Wakil Ketua</option>
                        <option value="Sekretaris">Sekretaris</option>
                        <option value="Wakil Sekretaris">Wakil Sekretaris</option>
                        <option value="Bendahara">Bendahara</option>
                        <option value="Wakil Bendahara">Wakil Bendahara</option>
                        <option value="Koordinator">Koordinator</option>
                        <option value="Anggota">Anggota</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="status_keanggotaan" class="block text-sm font-medium text-gray-700">Status Keanggotaan</label>
                    <select id="status_keanggotaan" name="status_keanggotaan" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                        <option value="Aktif">Aktif</option>
                        <option value="Non-Aktif">Non-Aktif</option>
                    </select>
                </div>

                <!-- Add other fields as necessary -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

