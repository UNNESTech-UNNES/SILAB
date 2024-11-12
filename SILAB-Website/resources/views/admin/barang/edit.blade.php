<x-main-layout>
    <div class="container py-4 px-4">
        <h1 class="text-xl text-center font-weight-bold">EDIT BARANG</h1>
        <form action="{{ route('admin.barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- Nama Barang -->
            <div class="form-group">
                <label for="nama_barang">Nama Barang:</label>
                <input type="text" class="form-control rounded" name="nama_barang" id="nama_barang" value="{{ $barang->nama_barang }}" required>
            </div>
            
            <!-- Jenis Barang -->
            <div class="form-group">
                <label for="jenis_barang">Jenis Barang:</label>
                <input type="text" class="form-control" name="jenis_barang" id="jenis_barang" value="{{ $barang->jenis_barang }}" required>
            </div>
            
            <!-- Letak Barang -->
            <div class="form-group">
                <label for="letak_barang">Letak Barang:</label>
                <input type="text" class="form-control rounded" name="letak_barang" id="letak_barang" value="{{ $barang->letak_barang }}" required>
            </div>
            
            <!-- Gambar -->
            <div class="form-group">
                <label for="gambar">Gambar:</label>
                <input type="file" class="form-control-file" name="gambar" id="gambar">
            </div>
            
            <button type="submit" class="btn btn-primary">Perbarui</button>
        </form>
    </div>
</x-main-layout>