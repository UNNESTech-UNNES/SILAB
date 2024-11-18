<x-app-layout>
    <x-navbar-header-user/>
        <section class="py-8 z-0">
            <div class="container mx-auto flex items-center flex-wrap">
                <x-list-barang :barangs="$barangs"/>
                <a href="{{ route('peminjam.keranjang.index') }}" class="btn btn-primary">Lihat Keranjang</a>
            </div>
        </section>

</x-app-layout>