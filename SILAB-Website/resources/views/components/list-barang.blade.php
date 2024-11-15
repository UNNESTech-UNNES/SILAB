@props(['barangs'])
<div class="flex flex-col justify-center w-full">
    <div class="w-full text-center">
        <h2 class="font-[Poppins] text-unnes-blue text-2xl font-extrabold">DAFTAR BARANG</h2>
    </div>
    <p class="text-md text-slate-400 text-center">Sistem Inventaris dan Peminjaman Barang Laboratorium</p>
    <div class="container top-0 px-32 pt-4 z-0">
        <div class="relative flex items-center">
            <input id="searchInput" class="w-full bg-slate-100 placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pr-3 pl-4 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Cari barang..." />
            <button id="searchButton" class="rounded-md ml-2 bg-unnes-blue p-2.5 border border-transparent text-center text-sm text-white transition-all shadow-sm hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                    <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>
</div>
<nav class="sticky top-0 bg-white flex-wrap">
    <div class="mx-auto gap-4">
        <div class="container z-30 top-0 px-32 pt-8 text-slate-500 text-sm">
          <a href="#" class="rounded-full border-2 px-3 py-1.5 hover:bg-unnes-blue hover:text-white">All</a>
          <a href="#" class="rounded-full border-2 px-3 py-1.5 hover:bg-unnes-blue hover:text-white">Ruang 1A</a>
          <a href="#" class="rounded-full border-2 px-3 py-1.5 hover:bg-unnes-blue hover:text-white">Ruang 1B</a>
          <a href="#" class="rounded-full border-2 px-3 py-1.5 hover:bg-unnes-blue hover:text-white">Ruang 1C</a>
          <a href="#" class="rounded-full border-2 px-3 py-1.5 hover:bg-unnes-blue hover:text-white">Ruang 1D</a>
          <a href="#" class="rounded-full border-2 px-3 py-1.5 hover:bg-unnes-blue hover:text-white">Ruang 2A</a>
          <a href="#" class="rounded-full border-2 px-3 py-1.5 hover:bg-unnes-blue hover:text-white">Ruang 2B</a>
          <a href="#" class="rounded-full border-2 px-3 py-1.5 hover:bg-unnes-blue hover:text-white">Ruang 2C</a>
          <a href="#" class="rounded-full border-2 px-3 py-1.5 hover:bg-unnes-blue hover:text-white">Ruang 2D</a>
        </div>
    </div>
</nav>
<div class="container mx-auto px-32 py-6">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach($barangs as $barang)
        <!-- Card Item -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-3">
              <img class="w-full h-48 object-cover rounded-lg" src="{{ asset('storage/' . $barang->gambar) }}" alt="Gambar Barang" />
                <div class="mt-3 space-y-2">
                    <div class="flex justify-between items-center">
                        <div class="px-2 py-0.5 bg-unnes-yellow rounded-lg">
                            <div class="flex items-center gap-1">
                                <span class="text-[#1a1a1a] text-xs font-semibold">Tersedia: {{ $barang->available_quantity }}/{{ $barang->total }}</span>
                            </div>
                        </div>
                        <div class="text-[#999999] text-xs">Ruang {{ $barang->letak_barang }}</div>
                    </div>
                    <div class="space-y-1">
                        <h3 class="text-black text-sm font-semibold">{{ $barang->nama_barang }}</h3>
                    </div>
                    <form action="{{ route('peminjam.keranjang.tambah') }}" method="POST">
                        @csrf
                        <input type="hidden" name="nama_barang" value="{{ $barang->nama_barang }}">
                        <input type="hidden" name="letak_barang" value="{{ $barang->letak_barang }}">
                        <button type="submit" class="w-full py-1.5 px-3 bg-unnes-blue hover:bg-[#c3d1e6] hover:text-black text-white text-xs rounded-full transition-colors duration-200 font-semibold" {{ $barang->available_quantity <= 0 ? 'disabled' : '' }}>Tambahkan ke Keranjang</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>