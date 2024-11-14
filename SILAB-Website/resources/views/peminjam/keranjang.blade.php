<div class="container">
    <a class="btn btn-primary" href="{{ route('peminjam.dashboard') }}">Kembali</a>
    <h1>Keranjang Peminjaman</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Letak Barang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($keranjangItems as $item)
            <tr>
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
    <form action="{{ route('peminjam.keranjang.finalisasi') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">Finalisasi Peminjaman</button>
    </form>
</div>