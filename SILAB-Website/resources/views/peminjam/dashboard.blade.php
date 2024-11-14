<div class="container">
    <h1>Dashboard Peminjam</h1>
    <div class="row">
        @foreach($barangs as $barang)
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">{{ $barang->nama_barang }}</h5>
                    <p class="card-text">
                        <img src="{{ asset('storage/' . $barang->gambar) }}" alt="Gambar Barang" style="width: 100px; height: 100px;">
                    </p>
                    <p class="card-text">Letak: {{ $barang->letak_barang }}</p>
                    <p class="card-text">Tersedia: {{ $barang->available_quantity }}/{{ $barang->total }}</p>
                    <form action="{{ route('peminjam.keranjang.tambah') }}" method="POST">
                        @csrf
                        <input type="hidden" name="nama_barang" value="{{ $barang->nama_barang }}">
                        <input type="hidden" name="letak_barang" value="{{ $barang->letak_barang }}">
                        <button type="submit" class="btn btn-primary" {{ $barang->available_quantity <= 0 ? 'disabled' : '' }}>Pinjam</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <a href="{{ route('peminjam.keranjang.index') }}" class="btn btn-primary">Lihat Keranjang</a>
</div>