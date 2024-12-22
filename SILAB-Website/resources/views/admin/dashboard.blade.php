<x-main-layout>
    <div class="container mx-auto px-4 py-8">
        <!-- Rekapitulasi Barang -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-unnes-blue mb-4">Rekapitulasi Barang</h2>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-unnes-blue text-white">
                        <tr>
                            <th class="px-6 py-3 text-left">Nama Barang</th>
                            <th class="px-6 py-3 text-left">Lokasi</th>
                            <th class="px-6 py-3 text-left">Jumlah Total</th>
                            <th class="px-6 py-3 text-left">Tersedia</th>
                            <th class="px-6 py-3 text-left">Dipinjam</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($rekapBarang as $rekap)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $rekap->nama_barang }}</td>
                            <td class="px-6 py-4">{{ $rekap->letak_barang }}</td>
                            <td class="px-6 py-4">{{ $rekap->total }}</td>
                            <td class="px-6 py-4">{{ $rekap->tersedia }}</td>
                            <td class="px-6 py-4">{{ $rekap->dipinjam }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Barang Yang Harus Segera Dikembalikan -->
        <div>
            <h2 class="text-2xl font-bold text-unnes-blue mb-4">Barang Yang Harus Segera Dikembalikan</h2>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-unnes-blue text-white">
                        <tr>
                            <th class="px-6 py-3 text-left">Nama Barang</th>
                            <th class="px-6 py-3 text-left">Peminjam</th>
                            <th class="px-6 py-3 text-left">Tanggal Pinjam</th>
                            <th class="px-6 py-3 text-left">Tanggal Kembali</th>
                            <th class="px-6 py-3 text-left">Sisa Hari</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($segeraKembali as $peminjaman)
                        <tr class="hover:bg-gray-50 {{ $peminjaman->sisa_hari <= 3 ? 'bg-red-50' : '' }}">
                            <td class="px-6 py-4">{{ $peminjaman->nama_barang }}</td>
                            <td class="px-6 py-4">{{ $peminjaman->nama_peminjam }}</td>
                            <td class="px-6 py-4">{{ $peminjaman->tanggal_peminjaman }}</td>
                            <td class="px-6 py-4">{{ $peminjaman->tanggal_pengembalian }}</td>
                            <td class="px-6 py-4">{{ $peminjaman->sisa_hari }} hari</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-main-layout>