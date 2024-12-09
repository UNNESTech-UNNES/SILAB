<x-app-layout>
    <x-navbar-header-user />
    <div class="mt-24">
    <a class="font-[Poppins] text-lg text-unnes-blue font-bold px-52 py-8 hover:text-unnes-blue/80" href="{{ route('peminjam.dashboard') }}">
        <i class="fa-solid fa-arrow-left"></i> Kembali
    </a>
    <div class="container items-start mx-auto px-32 py-1 grid grid-cols-2 gap-6">
        <!-- Keranjang Section -->
        <div class="flex flex-col items-center col-span-1 bg-white border-2 border-gray-300 rounded-lg shadow-black px-5 py-5">
            <h1 class="text-2xl font-bold pt-5 font-[Poppins] text-center mb-4">Keranjang Peminjaman</h1>
            <div id="controls-carousel" class="relative w-full rounded-md" data-carousel="static">
                <!-- Carousel wrapper -->
                <div class="relative w-full h-64 overflow-hidden rounded-lg">
                    @foreach($keranjangItems as $item)
                    <div class="{{ $loop->first ? 'block' : 'hidden' }} duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ asset('storage/' . $item->barang->gambar) }}" class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="{{ $item->nama_barang }}">
                    </div>
                    @endforeach
                </div>
                <!-- Slider indicators -->
                <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                    @foreach($keranjangItems as $index => $item)
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="{{ $loop->first ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}" data-carousel-slide-to="{{ $index }}"></button>
                    @endforeach
                </div>
                <!-- Slider controls -->
                <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
                        </svg>
                        <span class="sr-only">Previous</span>
                    </span>
                </button>
                <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="sr-only">Next</span>
                    </span>
                </button>
            </div>
            <table class="table w-full h-32 mb-4">
                <thead>
                    <tr class="text-center">
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Letak Barang</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($keranjangItems as $item)
                        <tr class="text-center">
                            <td>{{ $item->kode_barang }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->letak_barang }}</td>
                            <td>
                                <form action="{{ route('peminjam.keranjang.hapus', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger text-white bg-red-600 hover:bg-red-600/80 px-3 rounded-full">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Form Section -->
        <div class="flex-initial p-4 col-span-1 mx-auto w-full max-w-[550px] bg-white border-2 border-gray-300 rounded-lg shadow-black px-5 py-5">
            <form action="{{ route('peminjam.keranjang.finalisasi') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label for="nama" class="mb-3 block text-base font-medium text-[#07074D]">
                        Nama
                    </label>
                    <input type="text" name="nama" id="nama" value="{{ Auth::user()->name }}" 
                        class="text-sm w-full form-control rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring focus:ring-blue-500" required />
                </div>
                <div class="mb-5">
                    <label for="alamat" class="mb-3 block text-base font-medium text-[#07074D]">
                        Alamat
                    </label>
                    <input type="text" name="alamat" id="alamat" 
                        class="text-sm w-full form-control rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring focus:ring-blue-500" required />
                </div>
                <div class="mb-5">
                    <label for="nomor_handphone" class="mb-3 block text-base font-medium text-[#07074D]">
                        Nomor Handphone
                    </label>
                    <input type="text" name="nomor_handphone" id="nomor_handphone" 
                        class="text-sm w-full form-control rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring focus:ring-blue-500" required />
                </div>
                <div class="mb-6">
                    <label for="surat_tugas" class="block text-base font-medium text-[#07074D] mb-1">
                        Upload Foto Surat Tugas
                    </label>
                    <input type="file" id="surat_tugas" name="surat_tugas" accept="image/*,.pdf,.doc,.docx" 
                        class="bg-white text-sm block w-full border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="-mx-3 flex flex-wrap">
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="tanggal_dipinjam" class="mb-3 block text-base font-medium text-[#07074D]">
                                Tanggal Dipinjam
                            </label>
                            <input type="date" name="tanggal_dipinjam" id="tanggal_dipinjam" 
                                class="text-sm w-full form-control rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring focus:ring-blue-500" required />
                        </div>
                    </div>
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label for="tanggal_dikembalikan" class="mb-3 block text-base font-medium text-[#07074D]">
                                Tanggal Dikembalikan
                            </label>
                            <input type="date" name="tanggal_dikembalikan" id="tanggal_dikembalikan" 
                                class="text-sm w-full form-control rounded-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring focus:ring-blue-500" required />
                        </div>
                    </div>
                </div>
                <button type="submit" class="bg-unnes-blue text-white text-sm rounded-lg px-4 py-2 mb-4 inline-block hover:bg-unnes-blue/80">
                    Finalisasi Peminjaman
                </button>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('tanggal_dipinjam').value = today;
        });
    </script>
    </div>
</x-app-layout>