<x-app-layout>
    <x-navbar-header-user/>
    <div class="container mx-auto px-4 md:px-16 lg:px-32 py-8 mt-16">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-unnes-blue">{{ $title }}</h1>
            <button onclick="openModal()" class="bg-unnes-blue text-white px-4 py-2 rounded-lg hover:bg-unnes-blue/80 transition">
                <i class="fas fa-plus"></i>
                Tambah Barang
            </button>
        </div>

        <!-- Tab Navigation -->
        <div class="flex border-b-2 border-gray-200 w-full justify-between mb-6">
            <button onclick="changeTab('inventaris')" 
                    class="tab-btn flex justify-center w-full border-b-2 pb-4 border-unnes-blue text-unnes-blue" 
                    data-tab="inventaris">
                Inventaris Barang
            </button>
            <button onclick="changeTab('dipinjam')" 
                    class="tab-btn flex justify-center w-full text-gray-400 border-b-2 pb-4 border-transparent" 
                    data-tab="dipinjam">
                Barang Dipinjam
            </button>
        </div>

        <!-- Tab Content -->
        <div id="inventarisContent" class="tab-content">
            <!-- Filter Section -->
            <div class="bg-white mb-6">
                <div class="grid grid-cols-3 gap-4">
                    <input type="text" id="search" placeholder="Cari barang..." 
                        class="w-full px-4 py-2 rounded-lg border focus:ring focus:ring-unnes-blue/20">
                    <select id="filterLetak" class="px-4 py-2 rounded-lg border focus:ring focus:ring-unnes-blue/20">
                        <option value="">Semua Lokasi</option>
                        @foreach($letakBarang as $letak)
                            <option value="{{ $letak->letak_barang }}">{{ $letak->letak_barang }}</option>
                        @endforeach
                    </select>
                    <select id="status" class="px-4 py-2 rounded-lg border focus:ring focus:ring-unnes-blue/20">
                        <option value="">Semua Status</option>
                        <option value="tersedia">Tersedia</option>
                        <option value="dipinjam">Dipinjam</option>
                    </select>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-unnes-blue text-white">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium">Gambar</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Kode</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Nama</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Lokasi</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Status</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Dapat Dipinjam</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200" id="barangTable">
                            @include('pemilik.table-partial')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div id="dipinjamContent" class="tab-content hidden">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-unnes-blue text-white">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium">Kode Barang</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Nama Barang</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Lokasi</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Peminjam</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">No. HP</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Tgl Pinjam</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Tgl Kembali</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($barangDipinjam as $peminjaman)
                                <tr>
                                    <td class="px-6 py-4">{{ $peminjaman->kode_barang }}</td>
                                    <td class="px-6 py-4">{{ $peminjaman->nama_barang }}</td>
                                    <td class="px-6 py-4">{{ $peminjaman->letak_barang }}</td>
                                    <td class="px-6 py-4">{{ $peminjaman->nama_peminjam }}</td>
                                    <td class="px-6 py-4">{{ $peminjaman->nomor_handphone }}</td>
                                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($peminjaman->tanggal_peminjaman)->format('d M Y') }}</td>
                                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($peminjaman->tanggal_pengembalian)->format('d M Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                        Tidak ada barang yang sedang dipinjam
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Barang -->
    @include('pemilik.modal-tambah-barang')

    <!-- Modal Edit Barang -->
    <div id="modalEditBarang" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-40 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Edit Barang</h3>
                <form id="formEditBarang" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_barang_id">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Barang</label>
                        <input type="text" id="edit_nama_barang" name="nama_barang" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-unnes-blue">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Letak Barang</label>
                        <input type="text" id="edit_letak_barang" name="letak_barang" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-unnes-blue">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Barang</label>
                        <input type="file" name="gambar" accept="image/*"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-unnes-blue">
                        <img id="edit_preview_img" class="mt-2 w-full hidden h-48 object-cover rounded-md">
                    </div>

                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeEditModal()"
                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-unnes-blue text-white rounded-md hover:bg-unnes-blue/80">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function changeTab(tabId) {
            // Update active tab styling
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('border-unnes-blue', 'text-unnes-blue');
                btn.classList.add('text-gray-400', 'border-transparent');
            });
            
            const activeTab = document.querySelector(`[data-tab="${tabId}"]`);
            activeTab.classList.remove('text-gray-400', 'border-transparent');
            activeTab.classList.add('border-unnes-blue', 'text-unnes-blue');

            // Show/hide content
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });
            document.getElementById(`${tabId}Content`).classList.remove('hidden');
        }

        function openModal() {
            document.getElementById('modalTambahBarang').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modalTambahBarang').classList.add('hidden');
        }

        // Debounce function
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // Filter handling
        function updateTable() {
            const search = document.getElementById('search').value;
            const filterLetak = document.getElementById('filterLetak').value;
            const status = document.getElementById('status').value;

            const params = new URLSearchParams({
                search: search,
                filterLetak: filterLetak,
                status: status
            });

            fetch(`/pemilik/dashboard?${params.toString()}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                document.getElementById('barangTable').innerHTML = html;
            })
            .catch(error => console.error('Error:', error));
        }

        // Add event listeners after DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search');
            const filterLetakSelect = document.getElementById('filterLetak');
            const statusSelect = document.getElementById('status');

            searchInput.addEventListener('input', debounce(updateTable, 300));
            filterLetakSelect.addEventListener('change', updateTable);
            statusSelect.addEventListener('change', updateTable);
        });

        function editBarang(id) {
            fetch(`/pemilik/barang/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('edit_barang_id').value = id;
                        document.getElementById('edit_nama_barang').value = data.barang.nama_barang;
                        document.getElementById('edit_letak_barang').value = data.barang.letak_barang;
                        
                        const previewImg = document.getElementById('edit_preview_img');
                        previewImg.src = `/storage/${data.barang.gambar}`;
                        previewImg.classList.remove('hidden');
                        
                        document.getElementById('modalEditBarang').classList.remove('hidden');
                    }
                });
        }

        function closeEditModal() {
            document.getElementById('modalEditBarang').classList.add('hidden');
            document.getElementById('formEditBarang').reset();
            document.getElementById('edit_preview_img').classList.add('hidden');
        }

        document.getElementById('formEditBarang').addEventListener('submit', function(e) {
            e.preventDefault();
            const id = document.getElementById('edit_barang_id').value;
            const formData = new FormData(this);

            fetch(`/pemilik/barang/${id}`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    closeEditModal();
                    updateTable();
                    showAlert('success', 'Barang berhasil diperbarui');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('error', 'Terjadi kesalahan saat memperbarui barang');
            });
        });

        function deleteBarang(id) {
            if (confirm('Apakah Anda yakin ingin menghapus barang ini?')) {
                fetch(`/pemilik/barang/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
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
    </script>
    @endpush
</x-app-layout>