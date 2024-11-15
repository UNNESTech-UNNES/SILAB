<x-main-layout>
<div class="container">
    <h1>Daftar Peminjaman</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Letak Barang</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjamanList as $peminjaman)
            <tr>
                <td>{{ $peminjaman->kode_barang }}</td>
                <td>{{ $peminjaman->nama_barang }}</td>
                <td>{{ $peminjaman->letak_barang }}</td>
                <td>{{ $peminjaman->jumlah }}</td>
                <td>{{ $peminjaman->status }}</td>
                <td>
                    <form action="{{ route('admin.peminjaman.setujui', $peminjaman->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success">Setujui</button>
                    </form>
                    <form action="{{ route('admin.peminjaman.tolak', $peminjaman->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Tolak</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</x-main-layout>