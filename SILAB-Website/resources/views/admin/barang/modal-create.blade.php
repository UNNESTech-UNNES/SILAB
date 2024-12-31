<div id="modalCreateBarang" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-[600px] shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Tambah Barang Baru</h3>
            <form id="formCreateBarang" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Barang</label>
                        <input type="text" name="nama_barang" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-unnes-blue">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Barang</label>
                        <select name="jenis_barang" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-unnes-blue">
                            <option value="UMUM">UMUM</option>
                            <option value="SPARKA">SPARKA</option>
                            <option value="FACETRO">FACETRO</option>
                            <option value="SILAB">SILAB</option>
                            <option value="LMS">LMS</option>
                            <option value="REMOSTO">REMOSTO</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Letak Barang</label>
                        <input type="text" name="letak_barang" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-unnes-blue">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kondisi Barang</label>
                        <select name="kondisi_barang" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-unnes-blue">
                            <option value="baik">Baik</option>
                            <option value="rusak">Rusak</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah</label>
                        <input type="number" name="jumlah" min="1" value="1" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-unnes-blue">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gambar</label>
                        <input type="file" name="gambar" accept="image/*"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-unnes-blue">
                    </div>
                </div>

                <div class="flex justify-end gap-3 mt-4">
                    <button type="button" onclick="closeCreateModal()"
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