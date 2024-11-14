<x-main-layout>
    <div class="container py-4 px-4">
        <h1 class="text-xl text-center font-weight-bold">TAMBAH BARANG</h1>
        <form action="{{ route('admin.barang.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Nama Barang -->
            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" class="form-control rounded" name="nama_barang" id="nama_barang" required>
            </div>
        
            <!-- Jenis Barang -->
            <div class="form-group">
                <label for="jenis_barang">Jenis Barang</label>
                <select class="form-control" name="jenis_barang" id="jenis_barang" required>
                    <option value="MEDUNES">MEDUNES</option>
                    <option value="SILAB">SILAB</option>
                    <option value="SPARKA">SPARKA</option>
                    <option value="MELODY">MELODY</option>
                    <option value="FACETRO">FACETRO</option>
                    <option value="SENTIS">SENTIS</option>
                </select>
            </div>
        
            <!-- Letak Barang -->
            <div class="form-group">
                <label for="letak_barang">Letak Barang</label>
                <input type="text" class="form-control rounded" name="letak_barang" id="letak_barang" required>
            </div>
        
            <!-- Kondisi Barang -->
            <div class="form-group">
                <label for="kondisi_barang">Kondisi Barang</label>
                <select class="form-control" name="kondisi_barang" id="kondisi_barang" required>
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                </select>
            </div>
        
            <!-- Gambar -->
            <div class="form-group">
                <label for="gambar">Gambar</label>
                <input type="file" class="form-control-file" name="gambar" id="gambar">
            </div>
        
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</x-main-layout>