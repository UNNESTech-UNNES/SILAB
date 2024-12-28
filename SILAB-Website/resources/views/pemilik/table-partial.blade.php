@forelse($barangs as $barang)
<tr class="hover:bg-gray-50" id="barang-{{ $barang->id }}">
    <td class="px-6 py-4">
        <img src="{{ asset('storage/' . $barang->gambar) }}" alt="{{ $barang->nama_barang }}" class="w-48 h-24 rounded-md object-cover">
    </td>
    <td class="px-6 py-4">{{ $barang->kode_barang }}</td>
    <td class="px-6 py-4">{{ $barang->nama_barang }}</td>
    <td class="px-6 py-4">{{ $barang->letak_barang }}</td>
    <td class="px-6 py-4">
        <span class="px-2 py-1 text-xs rounded-full {{ $barang->status === 'tersedia' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
            {{ ucfirst($barang->status) }}
        </span>
    </td>
    <td class="px-6 py-4">
        <label class="relative inline-flex items-center cursor-pointer">
            <input type="checkbox" class="sr-only peer" {{ $barang->can_borrowed ? 'checked' : '' }}
                   onchange="toggleBorrow('{{ $barang->id }}', this)">
            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 
                        peer-focus:ring-blue-300 rounded-full peer 
                        peer-checked:after:translate-x-full peer-checked:after:border-white 
                        after:content-[''] after:absolute after:top-[2px] after:left-[2px] 
                        after:bg-white after:border-gray-300 after:border after:rounded-full 
                        after:h-5 after:w-5 after:transition-all peer-checked:bg-unnes-blue">
            </div>
        </label>
    </td>
    <td class="px-6 py-4">
        <div class="flex space-x-2">
            <button onclick="editBarang('{{ $barang->id }}')" 
                    class="text-yellow-600 hover:text-yellow-900">
                <i class="fas fa-edit"></i>
            </button>
            <button onclick="deleteBarang('{{ $barang->id }}')"
                    class="text-red-600 hover:text-red-900">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    </td>
</tr>
@empty
<tr>
    <td colspan="7" class="px-6 py-4 text-center text-gray-500">
        Tidak ada barang yang ditemukan
    </td>
</tr>
@endforelse

<script>
function toggleBorrow(barangId, element) {
    fetch(`/pemilik/barang/${barangId}/toggle-borrow`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) {
            // Jika gagal, kembalikan toggle ke posisi semula
            element.checked = !element.checked;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Jika terjadi error, kembalikan toggle ke posisi semula
        element.checked = !element.checked;
    });
}

function deleteBarang(id) {
    if (confirm('Apakah Anda yakin ingin menghapus barang ini?')) {
        fetch(`/pemilik/barang/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById(`barang-${id}`).remove();
                showAlert('success', 'Barang berhasil dihapus');
            } else {
                showAlert('error', data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('error', 'Terjadi kesalahan saat menghapus barang');
        });
    }
}

function editBarang(id) {
    fetch(`/pemilik/barang/${id}/edit`, {
        headers: {
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Isi form edit dengan data barang
            document.getElementById('edit_nama_barang').value = data.barang.nama_barang;
            document.getElementById('edit_letak_barang').value = data.barang.letak_barang;
            document.getElementById('edit_barang_id').value = data.barang.id;
            
            // Tampilkan preview gambar jika ada
            const previewImg = document.getElementById('edit_preview_img');
            if (previewImg) {
                previewImg.src = `/storage/${data.barang.gambar}`;
                previewImg.classList.remove('hidden');
            }
            
            // Buka modal edit
            document.getElementById('modalEditBarang').classList.remove('hidden');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('error', 'Terjadi kesalahan saat mengambil data barang');
    });
}

function showAlert(type, message) {
    const alertDiv = document.createElement('div');
    alertDiv.className = `fixed top-4 right-4 p-4 rounded-lg ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} text-white`;
    alertDiv.textContent = message;
    document.body.appendChild(alertDiv);
    setTimeout(() => alertDiv.remove(), 3000);
}
</script>