<div x-data="{ open: false }" @open-modal.window="if ($event.detail === 'modal-edit-{{$anggota->username}}') open = true" x-cloak>
    <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50" @click="open = false">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/2" @click.stop>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Edit Anggota</h2>
                <button @click="open = false" class="text-gray-500 hover:text-gray-700">&times;</button>
            </div>
            <form action="{{ route('anggota.update', $anggota->username) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="nim" class="block text-sm font-medium text-gray-700">NIM</label>
                    <input type="text" id="nim" name="nim" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500" value="{{$anggota->user_profile->nim}}" disabled>
                </div>

                <div class="mb-4">
                    <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500" value="{{$anggota->user_profile->nama_lengkap}}" disabled>
                </div>

                <div class="mb-4">
                    <label for="kode_divisi" class="block text-sm font-medium text-gray-700">Kode Divisi</label>
                    <select id="kode_divisi" name="kode_divisi" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                        @foreach($divisis as $divisi)
                            <option value="{{ $divisi->kode_divisi }}" {{ $divisi->kode_divisi == $anggota->kode_divisi ? 'selected' : '' }}>
                                {{ $divisi->nama_divisi }} ({{ $divisi->kode_divisi }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="jabatan" class="block text-sm font-medium text-gray-700">Jabatan</label>
                    <select id="jabatan" name="jabatan" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                        <option value="Ketua" {{ $anggota->jabatan == 'Ketua' ? 'selected' : '' }}>Ketua</option>
                        <option value="Wakil Ketua" {{ $anggota->jabatan == 'Wakil Ketua' ? 'selected' : '' }}>Wakil Ketua</option>
                        <option value="Sekretaris" {{ $anggota->jabatan == 'Sekretaris' ? 'selected' : '' }}>Sekretaris</option>
                        <option value="Wakil Sekretaris" {{ $anggota->jabatan == 'Wakil Sekretaris' ? 'selected' : '' }}>Wakil Sekretaris</option>
                        <option value="Bendahara" {{ $anggota->jabatan == 'Bendahara' ? 'selected' : '' }}>Bendahara</option>
                        <option value="Wakil Bendahara" {{ $anggota->jabatan == 'Wakil Bendahara' ? 'selected' : '' }}>Wakil Bendahara</option>
                        <option value="Koordinator" {{ $anggota->jabatan == 'Koordinator' ? 'selected' : '' }}>Koordinator</option>
                        <option value="Anggota" {{ $anggota->jabatan == 'Anggota' ? 'selected' : '' }}>Anggota</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="status_keanggotaan" class="block text-sm font-medium text-gray-700">Status Keanggotaan</label>
                    <select id="status_keanggotaan" name="status_keanggotaan" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                        <option value="Aktif" {{ $anggota->status_keanggotaan == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Non-Aktif" {{ $anggota->status_keanggotaan == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                    </select>
                </div>

                <div class="mt-6 flex justify-end">
                    <button @click="open = false" type="button" class="mr-3 px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">Cancel</button>
                    <button type="submit" class="bg-our_red text-white px-4 py-2 rounded-lg hover:bg-red-600">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>