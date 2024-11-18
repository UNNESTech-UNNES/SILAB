<div class="container">
    <a class="btn btn-primary" href="{{ route('peminjam.dashboard') }}">Kembali</a>
    <h1>Keranjang Peminjaman</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Letak Barang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($keranjangItems as $item)
            <tr>
                <td>{{ $item->kode_barang }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->letak_barang }}</td>
                <td>
                    <form action="{{ route('peminjam.keranjang.hapus', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Formulir Peminjaman</h2>
    <form action="{{ route('peminjam.keranjang.finalisasi') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ Auth::user()->name }}" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <input type="text" class="form-control" id="alamat" name="alamat" required>
        </div>
        <div class="form-group">
            <label for="nomor_handphone">Nomor Handphone:</label>
            <input type="text" class="form-control" id="nomor_handphone" name="nomor_handphone" required>
        </div>
        <div class="form-group">
            <label for="surat_tugas">Upload Foto Surat Tugas:</label>
            <input type="file" class="form-control" id="surat_tugas" name="surat_tugas" accept="image/*" required>
        </div>
        <div class="form-group">
            <label for="tanggal_dipinjam">Tanggal Dipinjam:</label>
            <input type="date" class="form-control" id="tanggal_dipinjam" name="tanggal_dipinjam" required>
        </div>
        <div class="form-group">
            <label for="tanggal_dikembalikan">Tanggal Akan Dikembalikan:</label>
            <input type="date" class="form-control" id="tanggal_dikembalikan" name="tanggal_dikembalikan" required>
        </div>
        <button type="submit" class="btn btn-success">Finalisasi Peminjaman</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('tanggal_dipinjam').value = today;
    });
</script>