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
                <form id="formEditBarang" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_barang_id" name="id">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Barang</label>
                            <input type="text" id="edit_nama_barang" name="nama_barang" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-unnes-blue">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Barang</label>
                            <select id="edit_jenis_barang" name="jenis_barang" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-unnes-blue">
                                <option value="UMUM">UMUM</option>
                                <option value="SPARKA">SPARKA</option>
                                <option value="FACETRO">FACETRO</option>
                                <option value="SILAB">SILAB</option>
                                <option value="LMS">LMS</option>
                                <option value="REMOSTO">REMOSTO</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Letak Barang</label>
                            <input type="text" id="edit_letak_barang" name="letak_barang" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-unnes-blue">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kondisi Barang</label>
                            <select id="edit_kondisi_barang" name="kondisi_barang" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-unnes-blue">
                                <option value="baik">Baik</option>
                                <option value="rusak">Rusak</option>
                            </select>
                        </div>

                        <div class="mb-4 col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Gambar</label>
                            <input type="file" name="gambar" accept="image/*"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-unnes-blue">
                            <img id="edit_preview_img" src="" alt="Preview" class="hidden mt-2 max-h-32">
                        </div>
                    </div>
                </form>
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
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('edit_barang_id').value = barangId;
                        document.getElementById('edit_nama_barang').value = data.barang.nama_barang;
                        document.getElementById('edit_jenis_barang').value = data.barang.jenis_barang;
                        document.getElementById('edit_letak_barang').value = data.barang.letak_barang;
                        document.getElementById('edit_kondisi_barang').value = data.barang.kondisi_barang;
                        
                        const previewImg = document.getElementById('edit_preview_img');
                        if (data.barang.gambar) {
                            previewImg.src = `/storage/${data.barang.gambar}`;
                            previewImg.classList.remove('hidden');
                        }
                        
                        document.getElementById('modalEdit').classList.remove('hidden');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memuat data barang');
                });
        }

        function closeEditModal() {
            document.getElementById('modalEdit').classList.add('hidden');
        }

        function changePerPage(value) {
            const params = new URLSearchParams(window.location.search);
            params.set('per_page', value);
            updateTable(1, params);
        }

        async function updateTable(page = 1) {
            try {
                const params = new URLSearchParams({
                    search: document.getElementById('searchInput').value,
                    filter_letak: document.getElementById('filterLetak').value,
                    filter_jenis: document.getElementById('filterJenis').value,
                    filter_kondisi: document.getElementById('filterKondisi').value,
                    per_page: document.getElementById('perPage').value,
                    page: page
                });

                const response = await fetch(`/admin/barang?${params.toString()}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const html = await response.text();
                document.getElementById('tableContainer').innerHTML = html;

                // Update URL tanpa reload
                const newUrl = `${window.location.pathname}?${params.toString()}`;
                window.history.pushState({ path: newUrl }, '', newUrl);
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memuat data');
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

        // Pindahkan event listener form edit ke dalam DOMContentLoaded
        document.addEventListener('DOMContentLoaded', function() {
            const formEdit = document.getElementById('formEditBarang');
            if (formEdit) {
                formEdit.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    const formData = new FormData(this);
                    const barangId = document.getElementById('edit_barang_id').value;

                    try {
                        const response = await fetch(`/admin/barang/${barangId}`, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'X-HTTP-Method-Override': 'PUT'
                            }
                        });

                        const data = await response.json();
                        
                        if (data.success) {
                            closeEditModal();
                            updateTable();
                            alert('Barang berhasil diperbarui');
                        } else {
                            alert(data.message || 'Gagal memperbarui barang');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat memperbarui barang');
                    }
                });
            }

            // Event listeners untuk filter
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('input', debounce(updateTable, 300));
            }

            const filterLetak = document.getElementById('filterLetak');
            if (filterLetak) {
                filterLetak.addEventListener('change', updateTable);
            }

            const filterJenis = document.getElementById('filterJenis');
            if (filterJenis) {
                filterJenis.addEventListener('change', updateTable);
            }

            const filterKondisi = document.getElementById('filterKondisi');
            if (filterKondisi) {
                filterKondisi.addEventListener('change', updateTable);
            }

            const formCreate = document.getElementById('formCreateBarang');
            if (formCreate) {
                formCreate.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    const formData = new FormData(this);

                    try {
                        const response = await fetch('/admin/barang', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json'
                            }
                        });

                        const data = await response.json();
                        
                        if (data.success) {
                            closeCreateModal();
                            updateTable();
                            this.reset();
                            alert('Barang berhasil ditambahkan');
                        } else {
                            alert(data.message || 'Gagal menambahkan barang');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menambahkan barang');
                    }
                });
            }
        });
    </script>
</x-main-layout>