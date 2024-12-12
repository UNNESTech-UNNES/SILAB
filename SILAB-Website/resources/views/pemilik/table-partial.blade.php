<table class="min-w-full bg-white">
    <thead class="bg-gray-100">
        <tr>
            <th class="py-2 px-4 border-b text-left">Nama Barang</th>
            <th class="py-2 px-4 border-b text-left">Kode Barang</th>
            <th class="py-2 px-4 border-b text-left">Letak</th>
            <th class="py-2 px-4 border-b text-left">Kondisi</th>
            <th class="py-2 px-4 border-b text-left">Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($barangs as $barang)
            <tr class="hover:bg-gray-50">
                <td class="py-2 px-4 border-b">{{ $barang->nama_barang }}</td>
                <td class="py-2 px-4 border-b">{{ $barang->kode_barang }}</td>
                <td class="py-2 px-4 border-b">{{ $barang->letak_barang }}</td>
                <td class="py-2 px-4 border-b">{{ $barang->kondisi_barang }}</td>
                <td class="py-2 px-4 border-b">
                    @if($barang->status == 'dipinjam')
                        <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-sm">
                            Dipinjam
                        </span>
                    @else
                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                            Tersedia
                        </span>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="py-4 px-4 text-center text-gray-500">
                    Tidak ada barang yang tersedia
                </td>
            </tr>
        @endforelse
    </tbody>
</table>