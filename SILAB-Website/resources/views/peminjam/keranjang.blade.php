<x-app-layout>
    <x-navbar-header-user/>
    <a class="btn btn-primary font-[Poppins] text-xl text-unnes-blue font-bold pt-10 pl-5" href="{{ route('peminjam.dashboard') }}">
        <i class="fa-solid fa-arrow-left"></i>Kembali</a>
    <div class="container items-start mx-auto px-32 py-1 grid grid-cols-2 gap-6 ">
        <div class="flex flex-col items-center col-span-1 bg-white border-2 border-gray-300 rounded-lg shadow-black px-5 py-5">
            <div id="controls-carousel" class="relative w-72 pt-3" data-carousel="static">
                <!-- Carousel wrapper -->
                <div class="relative h-72 overflow-hidden rounded-lg md:h-72">
                    <!-- Item 1 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ asset('assets/monitorasus1.png') }}" class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>
                    <!-- Item 2 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ asset('assets/monitorasus1.png') }}" class="absolute block w-full h-full object-cover -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>
                </div>
                <!-- Slider indicators -->
                <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                </div>
                <!-- Slider controls -->
                <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                        </svg>
                        <span class="sr-only">Previous</span>
                    </span>
                </button>
                <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="sr-only">Next</span>
                    </span>
                </button>
            </div>
            <div class="w-full p-4">
            <h1 class="text-2xl font-bold pt-5 font-[Poppins] text-center mb-4">Keranjang Peminjaman</h1>
                <table class="table w-full h-32 mb-4">
                    <thead>
                        <tr class="text-center">
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Letak</th>
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
        </div>
            <!-- Author: FormBold Team -->
        <div class="flex-initial p-4  col-span-1 mx-auto w-full max-w-[550px] bg-white border-2 border-gray-300 rounded-lg shadow-black px-5 py-5">
                <form>
                    <div class="mb-5">
                        <label for="name" class="mb-3 block text-base font-medium text-[#07074D]">
                            Nama Lengkap
                        </label>
                        <input type="text" name="name" id="name" placeholder="Masukkan Nama Lengkap"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    </div>
                    <div class="mb-5">
                        <label for="address" class="mb-3 block text-base font-medium text-[#07074D]">
                            Alamat
                        </label>
                        <input type="text" name="address" id="address" placeholder="Masukkan Alamat"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    </div>
                    <div class="mb-5">
                        <label for="phone" class="mb-3 block text-base font-medium text-[#07074D]">
                            Nomor Telepon
                        </label>
                        <input type="text" name="phone" id="phone" placeholder="Masukkan Nomor Telepon"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    </div>
                    <div class="mb-5">
                        <label for="email" class="mb-3 block text-base font-medium text-[#07074D]">
                            Alamat Email
                        </label>
                        <input type="email" name="email" id="email" placeholder="Masukkan Alamat Email"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    </div>
                    <div class="mb-6">
                        <label for="document" class="block text-base font-medium text-[#07074D] mb-1">Surat Tugas</label>
                        <input type="file" id="document" name="document" accept="pdf/*" class="w-full border-[#e0e0e0] bg-white text-base font-medium text-[#6B7280]">
                    </div>
                    <div class="-mx-3 flex flex-wrap">
                        <div class="w-full px-3 sm:w-1/2">
                            <div class="mb-5">
                                <label for="date" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Tanggal Peminjaman
                                </label>
                                <input type="date" name="date" id="date"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                            </div>
                        </div>
                        <div class="w-full px-3 sm:w-1/2">
                            <div class="mb-5">
                                <label for="date" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Tanggal Pengembalian
                                </label>
                                <input type="date" name="date" id="date"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                            </div>
                        </div>
                    </div>
        
                    <div>
                        <form action="{{ route('peminjam.keranjang.finalisasi') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success hover:shadow-form w-full rounded-md bg-unnes-blue hover:bg-unnes-blue/80 py-3 px-8 text-center text-base font-semibold text-white outline-none">Finalisasi Peminjaman</button>
                        </form>
                    </div>
                </form>
        </div>
    </div>
</x-app-layout>