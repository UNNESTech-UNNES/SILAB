@foreach($barangs as $barang)
        <!-- Card Item -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:-translate-y-1 transition">
            <div class="p-3">
                <img class="w-full h-48 object-cover rounded-lg" src="{{ asset('storage/' . $barang->gambar) }}" alt="Gambar Barang" />
                <div class="mt-3 space-y-2">
                    <div class="flex justify-between items-center">
                        <div class="px-2 py-0.5 bg-unnes-yellow rounded-lg">
                            <div class="flex items-center gap-1">
                                <span class="text-[#1a1a1a] text-xs font-semibold">Tersedia: {{ $barang->available_quantity }}/{{ $barang->total }}</span>
                            </div>
                        </div>
                        <div class="text-[#999999] text-xs">Ruang {{ $barang->letak_barang }}</div>
                    </div>
                    <div class="space-y-1">
                        <h3 class="text-black text-sm font-semibold">{{ $barang->nama_barang }}</h3>
                    </div>
                    <form action="{{ route('peminjam.keranjang.tambah') }}" method="POST">
                        @csrf
                        <input type="hidden" name="nama_barang" value="{{ $barang->nama_barang }}">
                        <input type="hidden" name="letak_barang" value="{{ $barang->letak_barang }}">
                        <button type="submit" class="w-full py-1.5 px-3 bg-unnes-blue hover:bg-[#c3d1e6] hover:text-black text-white text-xs rounded-full transition-colors duration-200 font-semibold" {{ $barang->available_quantity <= 0 ? 'disabled' : '' }}>
                                Tambahkan ke Keranjang
                        </button>
                    </form>
                </div>
            </div>
        </div>
@endforeach