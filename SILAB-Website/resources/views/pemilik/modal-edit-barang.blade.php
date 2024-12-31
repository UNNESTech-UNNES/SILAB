<div id="modalEditBarang" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
    <div class="relative top-40 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Edit Barang</h3>
            <form id="formEditBarang" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_barang_id">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Barang</label>
                    <input type="text" id="edit_nama_barang" name="nama_barang" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-unnes-blue">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Letak Barang</label>
                    <input type="text" id="edit_letak_barang" name="letak_barang" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-unnes-blue">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Barang</label>
                    <input type="file" name="gambar" accept="image/*"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-unnes-blue">
                    <img id="edit_preview_img" class="mt-2 w-full hidden h-48 object-cover rounded-md">
                </div>

                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-unnes-blue text-white rounded-md hover:bg-unnes-blue/80">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>