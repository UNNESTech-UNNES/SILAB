@props(['barangs', 'title'=>'DAFTAR BARANG'])

<div class="w-full h-full px-12 md:px-24 lg:px-32 gap-6 flex-col flex pb-32 bg-white">
    {{-- Fitur Pencarian --}}
    <div class="flex flex-col justify-center w-full">
        <div class="w-full text-center mt-2 md:mt-4 lg:mt-6">
            <h2 class="font-[Poppins] text-unnes-blue text-lg md:text-2xl font-extrabold">{{ $title }}</h2>
        </div>
        <p class=" text-sm md:text-md lg:text-lg text-slate-400 text-center">Sistem Inventaris dan Peminjaman Barang Laboratorium</p>
        <div class="relative flex items-center pt-4 h-max">
            <div class="flex w-full">
                <input id="searchInput" type="text" name="search" class="w-full bg-slate-100 placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pr-3 pl-4 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Cari barang..." />
            </div>
            <div class="flex items-center justify-center rounded-md ml-2 bg-unnes-blue p-2.5  border border-transparent text-center text-sm text-white transition-all shadow-sm hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
        </div>
    </div>

    {{-- Fitur Filter Ruangan --}}
    <nav class="sticky top-0 bg-white">
        <div class="container z-30 top-0 text-slate-500 flex overflow-x-scroll no-scrollbar text-sm md:text-md lg:text-lg">
            @php
                $currentFilter = request('filter', '');
            @endphp

            <button data-filter="" class="filter-btn rounded-full border-2 px-3 py-1.5 {{ $currentFilter == '' ? 'bg-unnes-blue text-white' : 'hover:bg-unnes-blue hover:text-white' }}">All</button>
            <button data-filter="1A" class="filter-btn rounded-full border-2 px-3 py-1.5 {{ $currentFilter == '1A' ? 'bg-unnes-blue text-white' : 'hover:bg-unnes-blue hover:text-white' }}">Ruang 1A</button>
            <button data-filter="1B" class="filter-btn rounded-full border-2 px-3 py-1.5 {{ $currentFilter == '1B' ? 'bg-unnes-blue text-white' : 'hover:bg-unnes-blue hover:text-white' }}">Ruang 1B</button>
            <button data-filter="2A" class="filter-btn rounded-full border-2 px-3 py-1.5 {{ $currentFilter == '1C' ? 'bg-unnes-blue text-white' : 'hover:bg-unnes-blue hover:text-white' }}">Ruang 2A</button>
            <button data-filter="2B" class="filter-btn rounded-full border-2 px-3 py-1.5 {{ $currentFilter == '1D' ? 'bg-unnes-blue text-white' : 'hover:bg-unnes-blue hover:text-white' }}">Ruang 2B</button>
            <button data-filter="3A" class="filter-btn rounded-full border-2 px-3 py-1.5 {{ $currentFilter == '2A' ? 'bg-unnes-blue text-white' : 'hover:bg-unnes-blue hover:text-white' }}">Ruang 3A</button>
            <button data-filter="3B" class="filter-btn rounded-full border-2 px-3 py-1.5 {{ $currentFilter == '2B' ? 'bg-unnes-blue text-white' : 'hover:bg-unnes-blue hover:text-white' }}">Ruang 3B</button>
            <button data-filter="4A" class="filter-btn rounded-full border-2 px-3 py-1.5 {{ $currentFilter == '2C' ? 'bg-unnes-blue text-white' : 'hover:bg-unnes-blue hover:text-white' }}">Ruang 4A</button>
            <button data-filter="4B" class="filter-btn rounded-full border-2 px-3 py-1.5 {{ $currentFilter == '2D' ? 'bg-unnes-blue text-white' : 'hover:bg-unnes-blue hover:text-white' }}">Ruang 4B</button>
        </div>
    </nav>

    {{-- Card Barang --}}
    <div id="barang-list" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        <x-barang-items :barangs="$barangs"/>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const filterButtons = document.querySelectorAll('.filter-btn');
    const barangList = document.getElementById('barang-list');
    
    // Get current route
    const currentRoute = window.location.pathname;
    
    let currentFilter = '';
    let searchTimeout;

    async function updateBarangList(params = {}) {
        try {
            const queryString = new URLSearchParams(params).toString();
            const response = await fetch(`${currentRoute}?${queryString}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                }
            });
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const html = await response.text();
            barangList.innerHTML = html;
            
            // Update URL tanpa reload
            const newUrl = `${window.location.pathname}?${queryString}`;
            window.history.pushState({ path: newUrl }, '', newUrl);
            
            // Update tampilan filter yang aktif
            updateActiveFilter(params.filter || '');
        } catch (error) {
            console.error('Error:', error);
        }
    }

    // Fungsi untuk update tampilan filter yang aktif
    function updateActiveFilter(activeFilter) {
        filterButtons.forEach(button => {
            const filterValue = button.getAttribute('data-filter');
            button.classList.remove('bg-unnes-blue', 'text-white');
            button.classList.add('hover:bg-unnes-blue', 'hover:text-white');
            
            if (filterValue === activeFilter) {
                button.classList.add('bg-unnes-blue', 'text-white');
                button.classList.remove('hover:bg-unnes-blue', 'hover:text-white');
            }
        });
    }

    // Event listener untuk input pencarian dengan debounce
    searchInput.addEventListener('input', function(e) {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            const params = { search: e.target.value };
            if (currentFilter) {
                params.filter = currentFilter;
            }
            updateBarangList(params);
        }, 300); // Delay 300ms
    });

    // Event listener untuk tombol filter
    filterButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            currentFilter = this.getAttribute('data-filter');
            const params = { filter: currentFilter };
            
            if (searchInput.value) {
                params.search = searchInput.value;
            }
            
            updateBarangList(params);
        });
    });

    // Handle browser back/forward
    window.addEventListener('popstate', function() {
        const params = new URLSearchParams(window.location.search);
        const searchParams = {};
        
        if (params.has('search')) {
            searchParams.search = params.get('search');
            searchInput.value = params.get('search');
        }
        
        if (params.has('filter')) {
            searchParams.filter = params.get('filter');
            currentFilter = params.get('filter');
        }
        
        updateBarangList(searchParams);
    });
});
</script>