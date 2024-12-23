<x-app-layout>
        <section class="container mx-auto px-4 md:px-16 lg:px-32 flex flex-col justify-center pt-16 md:pt-24 bg-white">
            {{-- <h1 class="font-[Poppins] text-unnes-blue text-2xl font-bold flex justify-center filter group-hover:invert pb-5">MENU</h1>
            <div class="container mx-auto flex flex-wrap justify-center gap-8 pb-5">
                <a href="{{ route('peminjam.keranjang.index') }}">
                    <div class="w-80 h-24 flex flex-row border-2 border-slate-200 rounded-lg shadow-md hover:bg-slate-200">
                        <div class="w-[33.3%] bg-unnes-blue flex justify-center items-center rounded-l-lg">
                            <i class="fa-solid fa-cart-shopping items-center justify-center text-5xl text-white"></i>
                        </div>
                        <div class="font-[Poppins] text-md flex-1 flex flex-col justify-end text-start p-5  hover:text-gray-700">
                            Keranjang
                        </div>
                    </div>
                </a>
                <a href="{{ route('peminjam.peminjaman.riwayat') }}">
                    <div class="w-80 h-24 flex flex-row border-2 border-slate-200 rounded-lg shadow-md hover:bg-slate-200">
                        <div class="w-[33.3%] bg-unnes-blue flex justify-center items-center rounded-l-lg">
                            <i class="fa-solid fa-clock-rotate-left items-center justify-center text-5xl text-white"></i>
                        </div>
                        <div class="font-[Poppins] text-md flex-1 flex flex-col justify-end text-start p-5 hover:text-gray-700">Riwayat Peminjaman
                        </div>
                    </div>
                </a>
                <a href="{{ route('peminjam.peminjaman.pengembalian') }}">
                    <div class="w-80 h-24 flex flex-row border-2 border-slate-200 rounded-xl shadow-md hover:bg-slate-200">
                        <div class="w-[33.3%] bg-unnes-blue flex justify-center items-center rounded-l-lg">
                            <i class="fa-solid fa-right-left items-center justify-center text-5xl text-white"></i>
                        </div>
                        <div class="font-[Poppins] text-md flex-1 flex flex-col justify-end text-start p-5 hover:text-gray-700">Pengembalian
                        </div>
                    </div>
                </a>
            </div> --}}
            <div class="container mx-auto flex items-center flex-wrap">
                <x-list-barang :barangs="$barangs"/>
            </div>
        </section>

    <script>
        document.getElementById('searchButton').addEventListener('click', function() {
            const query = document.getElementById('searchInput').value;
            if (query) {
                window.location.href = `/search?query=${encodeURIComponent(query)}`;
            } else {
                alert('Silakan masukkan kata kunci pencarian.');
            }
        });
    </script>
    <script>
        const navLinks = document.querySelector('.nav-links');
        function onToggleMenu(e) {
            e.name = e.name === 'menu' ? 'close' : 'menu';
            navLinks.classList.toggle('top-[9%]');
        }
    </script>
    <script>
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

        // Event listeners
        document.getElementById('search').addEventListener('input', debounce(updateTable, 300));
        document.getElementById('filterLetak').addEventListener('change', updateTable);
        document.getElementById('status').addEventListener('change', updateTable);

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
    </script>
    <x-footer-user/>
</x-app-layout>