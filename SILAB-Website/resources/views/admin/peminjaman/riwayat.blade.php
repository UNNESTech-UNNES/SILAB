<x-main-layout>
    <div class="container mx-auto px-4">
        <h1 class="text-2xl text-center font-bold pb-4 text-unnes-blue">RIWAYAT PEMINJAMAN</h1>
        
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="w-full border-collapse border border-gray-300">
                <thead class="text-white">
                    <tr class="bg-unnes-blue">
                        <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Kode Barang</th>
                        <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Nama Barang</th>
                        <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Nama Peminjam</th>
                        <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Tanggal Peminjaman</th>
                        <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Tanggal Pengembalian</th>
                        <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Tanggal Dikembalikan</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($riwayatBarang as $barang)
                    <tr class="hover:bg-slate-100">
                        <td class="px-6 py-3 text-left text-sm font-medium tracking-wider">{{ $barang->kode_barang }}</td>
                        <td class="px-6 py-3 text-left text-sm font-medium tracking-wider">{{ $barang->nama_barang }}</td>
                        <td class="px-6 py-3 text-left text-sm font-medium tracking-wider">{{ $barang->nama_peminjam }}</td>
                        <td class="px-6 py-3 text-left text-sm font-medium tracking-wider">{{ $barang->tanggal_peminjaman }}</td>
                        <td class="px-6 py-3 text-left text-sm font-medium tracking-wider">{{ $barang->tanggal_pengembalian }}</td>
                        <td class="px-6 py-3 text-left text-sm font-medium tracking-wider">{{ $barang->updated_at->format('Y-m-d') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-main-layout>