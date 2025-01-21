<div x-data="{ open: false }" @open-modal.window="if ($event.detail === 'modal-edit-{{$kegiatan->kode_kegiatan}}') open = true" x-cloak>
    <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50" @click="open = false">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/2" @click.stop>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Edit Kegiatan</h2>
                <button @click="open = false" class="text-gray-500 hover:text-gray-700">&times;</button>
            </div>
            <form action="{{ route('kegiatan.update', $kegiatan->kode_kegiatan) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="nama_kegiatan" class="block text-sm font-medium text-gray-700">Nama Kegiatan</label>
                    <input type="text" id="nama_kegiatan" name="nama_kegiatan" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500" value="{{ $kegiatan->nama_kegiatan }}">
                </div>

                <div class="mb-4">
                    <label for="kode_divisi" class="block text-sm font-medium text-gray-700">Kode Divisi</label>
                    <select id="kode_divisi" name="kode_divisi" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                        <option value="">Pilih Divisi</option>
                        @foreach($divisis as $divisi)
                            <option value="{{ $divisi->kode_divisi }}" {{ $divisi->kode_divisi == $kegiatan->kode_divisi ? 'selected' : '' }}>
                                {{ $divisi->nama_divisi }} ({{ $divisi->kode_divisi }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="lokasi_kegiatan" class="block text-sm font-medium text-gray-700">Lokasi Kegiatan</label>
                    <input type="text" id="lokasi_kegiatan" name="lokasi_kegiatan" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500" value="{{ $kegiatan->lokasi_kegiatan }}">
                </div>



                <div class="mb-4">
                    <label for="nim" class="block text-sm font-medium text-gray-700">NIM Penanggung Jawab</label>
                    <input type="text" 
                        id="nim" 
                        name="nim" 
                        value="{{ $kegiatan->penanggungJawab->user_profile->nim }}"
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
                    <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                    <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500" value="{{ $kegiatan->tanggal_mulai }}">
                </div>

                <div class="mb-4">
                    <label for="status_kegiatan" class="block text-sm font-medium text-gray-700">Status Kegiatan</label>
                    <select id="status_kegiatan" name="status_kegiatan" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                        <option value="Proses" {{ $kegiatan->status_kegiatan == 'Proses' ? 'selected' : '' }}>Proses</option>
                        <option value="Terlaksana" {{ $kegiatan->status_kegiatan == 'Terlaksana' ? 'selected' : '' }}>Terlaksana</option>
                        <option value="Dibatalkan" {{ $kegiatan->status_kegiatan == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="deskripsi_kegiatan" class="block text-sm font-medium text-gray-700">Deskripsi Kegiatan</label>
                    <textarea id="deskripsi_kegiatan" 
                            name="deskripsi_kegiatan" 
                            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">{{ $kegiatan->deskripsi_kegiatan }}</textarea>
                </div>

                <div class="mb-6" x-data="{ previewUrl: '{{ $kegiatan->gambar_kegiatan ? asset('storage/'.$kegiatan->gambar_kegiatan) : '' }}' }">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Media Upload</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 flex flex-col items-center justify-center">
                        <input type="file" 
                            name="gambar_kegiatan" 
                            id="gambar_kegiatan" 
                            class="hidden" 
                            x-ref="file"
                            accept=".jpg,.jpeg,.png"
                            @change="previewUrl = URL.createObjectURL($event.target.files[0])">
                            
                        <template x-if="!previewUrl">
                            <div class="text-center">
                                <p class="text-sm text-gray-500 mb-4">Drag your files here or click to upload</p>
                                <button type="button" 
                                        @click="$refs.file.click()" 
                                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                    Browse Files
                                </button>
                                <p class="text-sm text-gray-400 mt-2">Only .jpg, .png, and .jpeg allowed</p>
                            </div>
                        </template>
                        
                        <template x-if="previewUrl">
                            <div class="relative">
                                <img :src="previewUrl" class="max-w-full h-48 object-cover rounded mb-4">
                                <button type="button" 
                                        @click="previewUrl = null; $refs.file.value = ''" 
                                        class="absolute top-0 right-0 -mt-2 -mr-2 bg-red-500 text-white rounded-full p-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </template>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button @click="open = false" type="button" class="mr-3 px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">Cancel</button>
                    <button type="submit" class="bg-our_red text-white px-4 py-2 rounded-lg hover:bg-red-600">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>