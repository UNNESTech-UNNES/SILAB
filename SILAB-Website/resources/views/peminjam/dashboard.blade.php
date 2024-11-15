<x-app-layout>
    <x-navbar-header-user/>
        <section class="py-8 z-0">
            <div class="container mx-auto flex items-center flex-wrap">
                <x-list-barang :barangs="$barangs"/>
                <a href="{{ route('peminjam.keranjang.index') }}" class="btn btn-primary">Lihat Keranjang</a>
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