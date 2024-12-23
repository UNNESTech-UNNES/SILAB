@forelse($barangs as $barang)
<tr class="hover:bg-gray-50">
    <td class="px-6 py-4">{{ $barang->kode_barang }}</td>
    <td class="px-6 py-4">{{ $barang->nama_barang }}</td>
    <td class="px-6 py-4">{{ $barang->letak_barang }}</td>
    <td class="px-6 py-4">
        <span class="px-2 py-1 text-xs rounded-full {{ $barang->status === 'tersedia' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
            {{ ucfirst($barang->status) }}
        </span>
    </td>
    <td class="px-6 py-4">
        <button onclick="toggleBorrow('{{ $barang->id }}')" 
            class="px-2 py-1 text-xs rounded-full {{ $barang->can_borrowed ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
            {{ $barang->can_borrowed ? 'Ya' : 'Tidak' }}
        </button>
    </td>
</tr>
@empty
<tr>
    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
        Tidak ada barang yang ditemukan
    </td>
</tr>
@endforelse

<script>
function toggleBorrow(barangId) {
    fetch(`/pemilik/barang/${barangId}/toggle-borrow`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Refresh tabel
            updateTable();
        }
    });
}
</script>