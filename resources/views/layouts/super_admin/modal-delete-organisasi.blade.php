<div x-data="{ open: false }" @open-modal.window="if ($event.detail === 'delete-modal-{{$organisasi->kode_organisasi}}') open = true"x-cloak>
    <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-fit" @click.stop>
            <form action="{{ route('organisasi.destroy', $organisasi->kode_organisasi) }}" method="POST" @submit.prevent="$el.submit()">
                @csrf
                @method('DELETE')
                
                <h2 class="text-xl font-bold mb-4">Hapus Organisasi</h2>
                <p>Apakah anda yakin ingin menghapus {{ $organisasi->nama_organisasi }}?</p>

                <div class="mt-6 flex justify-end">
                    <button type="button" @click.stop="open = false" class="mr-3 px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
                        Cancel
                    </button>
                    <button type="submit" class="bg-our_red text-white px-4 py-2 rounded-lg hover:bg-red-600">
                        Delete
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>