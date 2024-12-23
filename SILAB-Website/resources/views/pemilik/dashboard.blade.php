<x-app-layout>
<<<<<<< HEAD
    <div class="py-6 md:py-12">
        <div class="max-w-full md:max-w-7xl mx-auto sm:px-4 md:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 md:p-6 text-gray-900">
                    <h2 class="text-xl md:text-2xl font-semibold mb-4">{{ $title }}</h2>
                    
                    {{-- Search dan Filter --}}
                    <div class="mb-4 flex flex-col md:flex-row gap-4">
                        <input type="text" 
                               id="searchInput"
                               placeholder="Cari barang..." 
                               class="border rounded px-3 py-1 w-full md:w-64">
                        
                        <select id="filterLetak" class="border rounded px-3 py-1 w-full md:w-auto">
                            <option value="">Semua Lokasi</option>
                            @foreach($letakBarang as $letak)
                                <option value="{{ $letak->letak_barang }}">
                                    Ruang {{ $letak->letak_barang }}
                                </option>
                            @endforeach
                        </select>
=======
    <x-navbar-header-user/>
    <div class="container mx-auto px-4 py-8 mt-16">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-unnes-blue">{{ $title }}</h1>
            <button onclick="openModal()" class="bg-unnes-blue text-white px-4 py-2 rounded-lg hover:bg-unnes-blue/80 transition">
                Tambah Barang
            </button>
        </div>
>>>>>>> bd00f2ac0e382a202d6aa252a75addfdab9a0879

        <!-- Filter Section -->
        <div class="bg-white p-4 rounded-lg shadow-md mb-6">
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <input type="text" id="search" placeholder="Cari barang..." 
                        class="w-full px-4 py-2 rounded-lg border focus:ring focus:ring-unnes-blue/20">
                </div>
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

        <!-- Inventaris Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Inventaris Barang</h2>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Lokasi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dapat Dipinjam</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200" id="barangTable">
                            @include('pemilik.table-partial')
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Barang Dipinjam Section -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">Barang Sedang Dipinjam</h2>
                <div class="space-y-4">
                    @forelse($barangDipinjam as $peminjaman)
                        <div class="border rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-medium">{{ $peminjaman->nama_barang }}</h3>
                                    <p class="text-sm text-gray-500">Peminjam: {{ $peminjaman->nama_peminjam }}</p>
                                    <p class="text-sm text-gray-500">Tanggal Kembali: {{ \Carbon\Carbon::parse($peminjaman->tanggal_pengembalian)->format('d M Y') }}</p>
                                </div>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                    Dipinjam
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Tidak ada barang yang sedang dipinjam</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Barang -->
    @include('pemilik.modal-tambah-barang')

    @push('scripts')
    <script>
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
    </script>
    @endpush
</x-app-layout>