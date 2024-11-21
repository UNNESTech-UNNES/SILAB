<x-main-layout>
    <div class="container">
        <h1>Daftar Peminjaman</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Nama Peminjam</th>
                    <th>Alamat</th>
                    <th>Nomor Handphone</th>
                    <th>Surat Tugas</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peminjamanList as $peminjaman)
                <tr>
                    <td>{{ $peminjaman->kode_barang }}</td>
                    <td>{{ $peminjaman->nama_barang }}</td>
                    <td>{{ $peminjaman->nama_peminjam }}</td>
                    <td>{{ $peminjaman->alamat_peminjam }}</td>
                    <td>{{ $peminjaman->nomor_handphone }}</td>
                    <td>
                        @if(pathinfo($peminjaman->surat_tugas, PATHINFO_EXTENSION) == 'pdf')
                            <a href="{{ asset('storage/' . $peminjaman->surat_tugas) }}" target="_blank">Lihat PDF</a>
                        @else
                            <img src="{{ asset('storage/' . $peminjaman->surat_tugas) }}" alt="Surat Tugas" style="max-width: 100px;">
                        @endif
                    </td>
                    <td>{{ $peminjaman->tanggal_peminjaman }}</td>
                    <td>{{ $peminjaman->tanggal_pengembalian }}</td>
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