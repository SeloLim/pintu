<div x-data="{ open: false }" @open-modal.window="if ($event.detail === 'edit-modal-{{$organisasi->kode_organisasi}}') open = true" x-cloak>
    <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50" @click="open = false">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/2" @click.stop>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Edit Organisasi</h2>
                <button @click="open = false" class="text-gray-500 hover:text-gray-700">&times;</button>
            </div>
            <form action="{{ route('organisasi.update', $organisasi->kode_organisasi) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="kode_organisasi" class="block text-sm font-medium text-gray-700">Kode Organisasi</label>
                    <input type="text" id="kode_organisasi" name="kode_organisasi" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500" value="{{$organisasi->kode_organisasi}}" disabled>
                </div>
                <div class="mb-4">
                    <label for="nama_organisasi" class="block text-sm font-medium text-gray-700">Nama Organisasi</label>
                    <input type="text" id="nama_organisasi" name="nama_organisasi" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500" value="{{$organisasi->nama_organisasi}}">
                </div>
                <div class="mb-4">
                    <label for="tipe_organisasi" class="block text-sm font-medium text-gray-700">Tipe Organisasi</label>
                    <select id="tipe_organisasi" name="tipe_organisasi" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                        <option value="Ormawa" {{ $organisasi->tipe_organisasi == 'Ormawa' ? 'selected' : '' }}>Ormawa</option>
                        <option value="UKM" {{ $organisasi->tipe_organisasi == 'UKM' ? 'selected' : '' }}>UKM</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="status_organisasi" class="block text-sm font-medium text-gray-700">Status Organisasi</label>
                    <select id="status_organisasi" name="status_organisasi" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                        <option value="Aktif" {{ $organisasi->status_organisasi == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Non-Aktif" {{ $organisasi->status_organisasi == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="tahun_berdiri" class="block text-sm font-medium text-gray-700">Tahun Berdiri</label>
                    <select id="tahun_berdiri" name="tahun_berdiri" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                        @for ($year = date('Y'); $year >= 2020; $year--)
                            <option value="{{ $year }}" {{ $organisasi->tahun_berdiri == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endfor
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