<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-unnes-blue">
            <tr>
                <th class="px-6 py-3 text-center text-sm font-medium text-white">Kode</th>
                <th class="px-6 py-3 text-center text-sm font-medium text-white">Nama</th>
                <th class="px-6 py-3 text-center text-sm font-medium text-white">Jenis</th>
                <th class="px-6 py-3 text-center text-sm font-medium text-white">Letak</th>
                <th class="px-6 py-3 text-center text-sm font-medium text-white">Kondisi</th>
                <th class="px-6 py-3 text-center text-sm font-medium text-white">Status</th>
                <th class="px-6 py-3 text-center text-sm font-medium text-white">Dapat Dipinjam</th>
                <th class="px-6 py-3 text-center text-sm font-medium text-white">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($barang as $item)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-center text-sm">{{ $item->kode_barang }}</td>
                <td class="px-6 py-4 text-center text-sm">{{ $item->nama_barang }}</td>
                <td class="px-6 py-4 text-center text-sm">{{ $item->jenis_barang }}</td>
                <td class="px-6 py-4 text-center text-sm">{{ $item->letak_barang }}</td>
                <td class="px-6 py-4 text-center text-sm">{{ $item->kondisi_barang }}</td>
                <td class="px-6 py-4 text-center text-sm">
                    <span class="px-2 py-1 text-sm text-center rounded-full {{ $item->status === 'tersedia' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                        {{ ucfirst($item->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 text-center">
                    <span class="px-2 py-1 text-sm rounded-full {{ $item->can_borrowed ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $item->can_borrowed ? 'Ya' : 'Tidak' }}
                    </span>
                </td>
                <td class="px-6 py-4 text-sm">
                    <div class="flex gap-2 justify-center">
                        <button onclick="openEditModal('{{ $item->id }}')" 
                            class="bg-unnes-blue text-white rounded h-8 w-8 flex items-center justify-center">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <button onclick="deleteBarang('{{ $item->id }}')"
                            class="bg-red-500 text-white rounded h-8 w-8 flex items-center justify-center hover:bg-red-600">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                    Tidak ada barang yang ditemukan
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div> 