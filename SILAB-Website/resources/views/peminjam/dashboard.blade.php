<x-app-layout>
    <x-navbar-header-user/>
        <section class="container mx-auto px-32 flex flex-col justify-center pt-24">
            <h1 class="font-[Poppins] text-unnes-blue text-2xl font-bold flex justify-center filter group-hover:invert pb-5">MENU</h1>
            <div class="container mx-auto flex flex-wrap justify-center gap-8 pb-5">
                <div class="w-80 h-32 flex flex-row border-2 border-slate-200 rounded-lg shadow-md">
                    <div class="w-[33.3%] bg-unnes-blue flex justify-center items-center rounded-l-lg">
                        <i class="fa-solid fa-cart-shopping items-center justify-center text-5xl text-white"></i>
                    </div>
                    <div class="font-[Poppins] text-xl flex-1 flex flex-col justify-end text-start p-5  hover:text-gray-700">
                        <a href="{{ route('peminjam.keranjang.index') }}">Keranjang</a>
                    </div>
                </div>
                <div class="w-80 h-32 flex flex-row border-2 border-slate-200 rounded-lg shadow-md">
                    <div class="w-[33.3%] bg-unnes-blue flex justify-center items-center rounded-l-lg">
                        <i class="fa-solid fa-clock-rotate-left items-center justify-center text-5xl text-white"></i>
                    </div>
                    <div class="font-[Poppins] text-xl flex-1 flex flex-col justify-end text-start p-5 hover:text-gray-700">Riwayat Peminjaman
                        {{-- <a href="{{ route('peminjam.barangpinjam.index') }}">Barang Dipinjam</a> --}}
                    </div>
                </div>
                <div class="w-80 h-32 flex flex-row border-2 border-slate-200 rounded-xl shadow-md">
                    <div class="w-[33.3%] bg-unnes-blue flex justify-center items-center rounded-l-lg ">
                        <i class="fa-solid fa-right-left items-center justify-center text-5xl text-white"></i>
                    </div>
                    <div class="font-[Poppins] text-xl flex-1 flex flex-col justify-end text-start p-5 hover:text-gray-700">Pengembalian
                        {{-- <a href="{{ route('peminjam.pengembalian.index') }}">Pengembalian</a> --}}
                    </div>
                </div>
            </div>
            <div class="container mx-auto flex items-center flex-wrap">
                <x-list-barang :barangs="$barangs"/>
                {{-- <a href="{{ route('peminjam.keranjang.index') }}" class="btn btn-primary">Lihat Keranjang</a> --}}
            </div>
        </section>
        <script>
            document.getElementById('searchButton').addEventListener('click', function() {
                const query = document.getElementById('searchInput').value;
                if (query) {
                    // Lakukan pencarian atau kirimkan query ke server
                    console.log('Mencari:', query);
                    // Contoh: Anda bisa mengarahkan ke URL pencarian
                    // window.location.href = `/search?query=${encodeURIComponent(query)}`;
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
</x-app-layout>
