<x-app-layout>
    <x-navbar-header-user/>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold mb-4">{{ $title }}</h2>
                    
                    {{-- Search dan Filter --}}
                    <div class="mb-4 flex gap-4">
                        <input type="text" 
                               id="searchInput"
                               placeholder="Cari barang..." 
                               class="border rounded px-3 py-1 w-64">
                        
                        <select id="filterLetak" class="border rounded px-3 py-1">
                            <option value="">Semua Lokasi</option>
                            @foreach($letakBarang as $letak)
                                <option value="{{ $letak->letak_barang }}">
                                    Ruang {{ $letak->letak_barang }}
                                </option>
                            @endforeach
                        </select>

                        <button type="button" 
                                id="resetButton"
                                class="bg-gray-500 text-white px-4 py-1 rounded hover:bg-gray-600 hidden">
                            Reset
                        </button>
                    </div>

                    {{-- Tabel Barang --}}
                    <div class="overflow-x-auto" id="tableContainer">
                        @include('pemilik.table-partial', ['barangs' => $barangs])
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const filterLetak = document.getElementById('filterLetak');
            const resetButton = document.getElementById('resetButton');
            const tableContainer = document.getElementById('tableContainer');
            
            let searchTimeout;

            function updateTable() {
                const search = searchInput.value;
                const filter = filterLetak.value;
                
                // Tampilkan/sembunyikan tombol reset
                resetButton.classList.toggle('hidden', !search && !filter);

                // Buat URL dengan parameter
                const params = new URLSearchParams();
                if (search) params.append('search', search);
                if (filter) params.append('filterLetak', filter);

                // Kirim request AJAX
                fetch(`${window.location.pathname}?${params.toString()}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    tableContainer.innerHTML = html;
                })
                .catch(error => console.error('Error:', error));
            }

            // Event listener untuk pencarian dengan debounce
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(updateTable, 300);
            });

            // Event listener untuk filter
            filterLetak.addEventListener('change', updateTable);

            // Event listener untuk reset
            resetButton.addEventListener('click', function() {
                searchInput.value = '';
                filterLetak.value = '';
                updateTable();
            });
        });
    </script>
    @endpush
</x-app-layout>