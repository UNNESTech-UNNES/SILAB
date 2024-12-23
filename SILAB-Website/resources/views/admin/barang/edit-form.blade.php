<form id="formEditBarang" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="grid grid-cols-2 gap-4">
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Barang</label>
            <input type="text" name="nama_barang" value="{{ $barang->nama_barang }}" required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-unnes-blue">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Barang</label>
            <input type="text" name="jenis_barang" value="{{ $barang->jenis_barang }}" required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-unnes-blue">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Letak Barang</label>
            <input type="text" name="letak_barang" value="{{ $barang->letak_barang }}" required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-unnes-blue">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Kondisi Barang</label>
            <select name="kondisi_barang" required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-unnes-blue">
                <option value="baik" {{ $barang->kondisi_barang == 'baik' ? 'selected' : '' }}>Baik</option>
                <option value="rusak" {{ $barang->kondisi_barang == 'rusak' ? 'selected' : '' }}>Rusak</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Gambar</label>
            <input type="file" name="gambar" accept="image/*"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-unnes-blue">
        </div>
    </div>
</form> 