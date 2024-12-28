<x-main-layout>
    <div class="container mx-auto px-4 pb-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-unnes-blue">INVENTARIS BARANG LABORATORIUM</h1>
            <button onclick="openCreateModal()" class="bg-unnes-blue text-white px-4 py-2 rounded-lg hover:bg-unnes-blue/80">
                <i class="fa-solid fa-plus"></i>
                Tambah Barang
            </button>
        </div>

        <!-- Filter Section -->
        <div class="bg-white mb-6">
            <div class="grid grid-cols-4 gap-4">
                <input type="text" id="searchInput" placeholder="Cari barang..." 
                    class="px-4 py-2 rounded-lg border focus:ring focus:ring-unnes-blue/20">
                
                <select id="filterLetak" class="px-4 py-2 rounded-lg border focus:ring focus:ring-unnes-blue/20">
                    <option value="">Semua Lokasi</option>
                    @foreach($letakBarang as $letak)
                        <option value="{{ $letak->letak_barang }}">{{ $letak->letak_barang }}</option>
                    @endforeach
                </select>

                <select id="filterJenis" class="px-4 py-2 rounded-lg border focus:ring focus:ring-unnes-blue/20">
                    <option value="">Semua Jenis</option>
                    @foreach($jenisBarang as $jenis)
                        <option value="{{ $jenis->jenis_barang }}">{{ $jenis->jenis_barang }}</option>
                    @endforeach
                </select>

                <select id="filterKondisi" class="px-4 py-2 rounded-lg border focus:ring focus:ring-unnes-blue/20">
                    <option value="">Semua Kondisi</option>
                    @foreach($kondisiBarang as $kondisi)
                        <option value="{{ $kondisi->kondisi_barang }}">{{ $kondisi->kondisi_barang }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Table Section -->
        <div id="tableContainer">
            @include('admin.barang.table-partial')
        </div>
    </div>

    @include('admin.barang.modal-create')

    <div id="modalEdit" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-[600px] shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Edit Barang</h3>
                <div id="modalContent">
                    <!-- Form will be loaded here -->
                </div>
                <div class="flex justify-end gap-3 mt-4">
                    <button type="button" onclick="closeEditModal()"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                        Batal
                    </button>
                    <button type="submit" form="formEditBarang"
                        class="px-4 py-2 bg-unnes-blue text-white rounded-md hover:bg-unnes-blue/80">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Define global functions first
        function openCreateModal() {
            document.getElementById('modalCreateBarang').classList.remove('hidden');
        }

        function closeCreateModal() {
            document.getElementById('modalCreateBarang').classList.add('hidden');
        }

        function openEditModal(barangId) {
            fetch(`/admin/barang/${barangId}/edit`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('modalContent').innerHTML = html;
                    document.getElementById('modalEdit').classList.remove('hidden');
                });
        }

        function closeEditModal() {
            document.getElementById('modalEdit').classList.add('hidden');
        }

        async function updateTable() {
            const params = new URLSearchParams({
                search: document.getElementById('searchInput').value,
                filter_letak: document.getElementById('filterLetak').value,
                filter_jenis: document.getElementById('filterJenis').value,
                filter_kondisi: document.getElementById('filterKondisi').value
            });

            try {
                const response = await fetch(`/admin/barang/table?${params.toString()}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                
                const html = await response.text();
                document.getElementById('tableContainer').innerHTML = html;
            } catch (error) {
                console.error('Error:', error);
            }
        }

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

        function deleteBarang(barangId) {
            if (confirm('Apakah Anda yakin ingin menghapus barang ini?')) {
                fetch(`/admin/barang/${barangId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        updateTable();
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        }

        // DOM ready event listener
        document.addEventListener('DOMContentLoaded', function() {
            // Setup form create submission
            document.getElementById('formCreateBarang').addEventListener('submit', async function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                try {
                    const response = await fetch('{{ route("admin.barang.store") }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });

                    if (response.ok) {
                        closeCreateModal();
                        updateTable();
                        this.reset();
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            });

            // Event listeners untuk filter
            document.getElementById('searchInput').addEventListener('input', debounce(updateTable, 300));
            document.getElementById('filterLetak').addEventListener('change', updateTable);
            document.getElementById('filterJenis').addEventListener('change', updateTable);
            document.getElementById('filterKondisi').addEventListener('change', updateTable);
        });
    </script>
</x-main-layout>