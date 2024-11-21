<x-main-layout>
    <div class="container px-4">
        <h1 class="text-2xl text-center font-bold pb-4 text-unnes-blue">TAMBAH BARANG</h1>
        <form action="{{ route('admin.barang.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Nama Barang -->
            <div class="mb-4">
                <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                <input type="text" class="text-sm w-full form-control rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring focus:ring-blue-500" name="nama_barang" id="nama_barang" required>
            </div>

            <!-- Jenis Barang -->
            <div class="mb-4">
                <label for="jenis_barang" class="block text-sm font-medium text-gray-700">Jenis Barang</label>
                <select class="text-sm w-full form-control rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring focus:ring-blue-500" name="jenis_barang" id="jenis_barang" required>
                    <option value="MEDUNES">MEDUNES</option>
                    <option value="SILAB">SILAB</option>
                    <option value="SPARKA">SPARKA</option>
                    <option value="MELODY">MELODY</option>
                    <option value="FACETRO">FACETRO</option>
                    <option value="SENTIS">SENTIS</option>
                </select>
            </div>
        
            <!-- Letak Barang -->
            <div class="mb-4">
                <label for="letak_barang" class="block text-sm font-medium text-gray-700">Letak Barang</label>
                <input type="text" class="text-sm w-full form-control rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring focus:ring-blue-500" name="letak_barang" id="letak_barang" required>
            </div>
        
            <!-- Kondisi Barang -->
            <div class="mb-4">
                <label for="kondisi_barang" class="block text-sm font-medium text-gray-700">Kondisi Barang</label>
                <select class="text-sm w-full form-control rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring focus:ring-blue-500" name="kondisi_barang" id="kondisi_barang" required>
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                </select>
            </div>
        
            <!-- Gambar -->
            <div class="mb-4 text-sm">
                <label for="gambar" class="block text-sm font-medium text-gray-700">Gambar</label>
                <input type="file" class="bg-white text-sm block w-full border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500" name="gambar" id="gambar">
            </div>
        
            <button type="submit" class="bg-unnes-blue text-white text-sm rounded-lg px-4 py-2 mb-4 inline-block">Simpan</button>
        </form>
    </div>
</x-main-layout>