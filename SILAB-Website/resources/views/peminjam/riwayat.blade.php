<x-app-layout>
    <div class="container flex mx-auto px-32 py-8 mt-12 pt-4">
        <a class="font-[Poppins] text-lg text-unnes-blue font-bold pt-10 pl-3 hover:text-unnes-blue/60" href="{{ route('peminjam.dashboard') }}">
            <i class="fa-solid fa-arrow-left"></i> Kembali</a>        
    </div>

    @if($riwayatPeminjaman->isEmpty())
        <div class="container mx-auto px-32 py-10">
            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                <div class="flex flex-col items-center gap-4">
                    <i class="fas fa-history text-6xl text-gray-300"></i>
                    <h2 class="text-2xl font-semibold text-gray-600">Belum Ada Riwayat</h2>
                    <p class="text-gray-500">Anda belum pernah meminjam barang di SILAB</p>
                    <a href="{{ route('peminjam.dashboard') }}" class="bg-unnes-blue text-white px-6 py-2 rounded-lg hover:bg-unnes-blue/80 transition">
                        Mulai Meminjam
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="container mx-auto px-32">
            <h1 class="text-2xl font-bold mb-6">Riwayat Peminjaman</h1>

            <!-- Sedang Dipinjam -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold mb-4">Sedang Dipinjam</h2>
                <div class="space-y-4">
                    @forelse($sedangDipinjam as $item)
                        <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition">
                            <div class="flex items-start gap-4">
                                <img src="{{ asset('storage/' . $item->barang->gambar) }}" class="w-32 h-32 object-cover rounded-lg" alt="{{ $item->nama_barang }}">
                                <div class="flex-grow">
                                    <div class="flex justify-between">
                                        <div>
                                            <h3 class="font-semibold text-lg">{{ $item->nama_barang }}</h3>
                                            <p class="text-gray-500 text-sm">{{ $item->kode_barang }}</p>
                                            <p class="text-gray-500 text-sm">Ruang {{ $item->letak_barang }}</p>
                                        </div>
                                        <div class="text-right">
                                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                                Sedang Dipinjam
                                            </span>
                                            <p class="text-sm text-gray-500 mt-1">
                                                Dikembalikan: {{ \Carbon\Carbon::parse($item->tanggal_pengembalian)->format('d M Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Tidak ada barang yang sedang dipinjam</p>
                    @endforelse
                </div>
            </div>

            <!-- Riwayat Selesai -->
            <div>
                <h2 class="text-lg font-semibold mb-4">Riwayat Selesai</h2>
                <div class="space-y-4">
                    @forelse($riwayatSelesai as $item)
                        <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition">
                            <div class="flex items-start gap-4">
                                <img src="{{ asset('storage/' . $item->barang->gambar) }}" class="w-32 h-32 object-cover rounded-lg" alt="{{ $item->nama_barang }}">
                                <div class="flex-grow">
                                    <div class="flex justify-between">
                                        <div>
                                            <h3 class="font-semibold text-lg">{{ $item->nama_barang }}</h3>
                                            <p class="text-gray-500 text-sm">{{ $item->kode_barang }}</p>
                                            <p class="text-gray-500 text-sm">Ruang {{ $item->letak_barang }}</p>
                                        </div>
                                        <div class="text-right">
                                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                                Selesai
                                            </span>
                                            <p class="text-sm text-gray-500 mt-1">
                                                Dipinjam: {{ \Carbon\Carbon::parse($item->tanggal_peminjaman)->format('d M Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Belum ada riwayat peminjaman selesai</p>
                    @endforelse
                </div>
            </div>
        </div>
    @endif
</x-app-layout>