<x-app-layout>
    <x-navbar-header-user/>
        <section class="flex flex-col justify-center w-full">
            <h1 class="font-[Poppins] text-unnes-blue text-2xl font-bold flex justify-center pb-3 filter group-hover:invert">Menu Layanan</h1>
            <div class="flex justify-center space-x-3 pb-5 gap-3">
                <div class="btn btn-primary w-80 h-32 flex flex-row border-2 border-unnes-yellow rounded-lg shadow-md">
                    <div class="w-[20%] bg-unnes-yellow flex justify-center items-center">
                        <img class="h-32 bg-unnes-yellow" src="{{ asset('assets/Icon Keranjang.svg') }}" alt="Icon Keranjang">
                    </div>
                    <div class="font-[Poppins] text-2xl flex-1 text-center hover:text-gray-700">
                        <a href="{{ route('peminjam.keranjang.index') }}">Keranjang</a>
                    </div>
                </div>
                <div class="btn btn-primary w-80 h-32 flex flex-row border-2 border-unnes-yellow rounded-lg shadow-md">
                    <div class="w-[20%] bg-unnes-yellow flex justify-center items-center">
                        <img class="h-12 w-auto bg-unnes-yellow" src="{{ asset('assets/icon-pinjam.png') }}" alt="Icon Barang Dipinjam">
                    </div>
                    <div class="font-[Poppins] text-2xl flex-1 text-center hover:text-gray-700">Riwayat Peminjaman
                        {{-- <a href="{{ route('peminjam.barangpinjam.index') }}">Barang Dipinjam</a> --}}
                    </div>
                </div>
                <div class="btn btn-primary w-80 h-32 flex flex-row border-2 border-unnes-yellow rounded-lg shadow-md">
                    <div class="w-[20%] bg-unnes-yellow flex justify-center items-center">
                        <img class="h-12 w-auto bg-unnes-yellow" src="{{ asset('assets/return-icon.png') }}" alt="Icon Pengembalian">
                    </div>
                    <div class="font-[Poppins] text-2xl flex-1 text-center hover:text-gray-700">Pengembalian
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
