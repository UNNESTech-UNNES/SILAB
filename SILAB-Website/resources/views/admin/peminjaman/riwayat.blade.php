<x-main-layout>
    <h1 class="text-2xl text-center font-bold pb-4 text-unnes-blue">RIWAYAT PEMINJAMAN BARANG</h1>

    <div class="bg-white shadow-md rounded-lg pb-6 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-full divide-y divide-gray-200">
                <thead class="bg-white">
                    <tr class="bg-unnes-blue text-white">
                        <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Kode Barang</th>
                            <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Nama Barang</th>
                            <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Nama Peminjam</th>
                            <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Alamat</th>
                            <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Nomor Handphone</th>
                            <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Tanggal Peminjaman</th>
                            <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Tanggal Pengembalian</th>
                            <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($riwayatBarang as $barang)
                    <tr class="hover:bg-slate-100">
                        <td class="px-6 py-3 text-left text-sm font-medium tracking-wider">{{ $barang->kode_barang }}</td>
                        <td class="px-6 py-3 text-left text-sm font-medium tracking-wider">{{ $barang->nama_barang }}</td>
                        <td class="px-6 py-3 text-left text-sm font-medium tracking-wider">{{ $barang->nama_peminjam }}</td>
                        <td class="px-6 py-3 text-left text-sm font-medium tracking-wider">{{ $barang->alamat_peminjam }}</td>
                        <td class="px-6 py-3 text-left text-sm font-medium tracking-wider">{{ $barang->nomor_handphone}}</td>
                        <td class="px-6 py-3 text-left text-sm font-medium tracking-wider">{{ $barang->tanggal_peminjaman }}</td>
                        <td class="px-6 py-3 text-left text-sm font-medium tracking-wider">{{ $barang->tanggal_pengembalian }}</td>
                        <td class="px-6 py-3 text-left text-sm font-medium tracking-wider">{{ $barang->status}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-main-layout>