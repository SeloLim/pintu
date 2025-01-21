<div x-data="{ open: false }" @open-modal.window="if ($event.detail === 'modal-edit-{{$divisi->kode_divisi}}') open = true" x-cloak>
    <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50" @click="open = false">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/2" @click.stop>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Edit Divisi</h2>
                <button @click="open = false" class="text-gray-500 hover:text-gray-700">&times;</button>
            </div>
            <form action="{{ route('divisi.update', $divisi->kode_divisi) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="kode_divisi" class="block text-sm font-medium text-gray-700">Kode Divisi</label>
                    <input type="text" id="kode_divisi" name="kode_divisi" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500" value="{{$divisi->kode_divisi}}" disabled>
                </div>

                <div class="mb-4">
                    <label for="nama_divisi" class="block text-sm font-medium text-gray-700">Nama Divisi</label>
                    <input type="text" id="nama_divisi" name="nama_divisi" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500" value="{{$divisi->nama_divisi}}">
                </div>

                <div class="mb-4">
                    <label for="status_divisi" class="block text-sm font-medium text-gray-700">Status Divisi</label>
                    <select id="status_divisi" name="status_divisi" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                        <option value="Aktif" {{ $divisi->status_divisi == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Non-Aktif" {{ $divisi->status_divisi == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="deskripsi_divisi" class="block text-sm font-medium text-gray-700">Deskripsi Divisi</label>
                    <textarea id="deskripsi_divisi" name="deskripsi_divisi" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">{{$divisi->deskripsi_divisi}}</textarea>
                </div>

                <div class="mt-6 flex justify-end">
                    <button @click="open = false" type="button" class="mr-3 px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">Cancel</button>
                    <button type="submit" class="bg-our_red text-white px-4 py-2 rounded-lg hover:bg-red-600">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>