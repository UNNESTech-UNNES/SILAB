<x-app-layout>
    <div class="container px-4 md:px-8 lg:px-32 mx-auto pt-16 md:pt-24 space-y-6">
        <x-title-header title="KERANJANG PEMINJAMAN"/>

        @if($keranjangItems->isEmpty())
            <div class="container mx-auto pt-24">
                <div class="p-8 text-center">
                    <div class="flex flex-col items-center gap-4">
                        <i class="fas fa-shopping-cart text-9xl text-gray-300"></i>
                        <h2 class="text-2xl font-semibold text-gray-600">Keranjang Kosong</h2>
                        <p class="text-gray-500">Anda belum menambahkan barang ke keranjang</p>
                        <a href="{{ route('peminjam.dashboard') }}" class="bg-unnes-blue text-white px-6 py-2 rounded-lg hover:bg-unnes-blue/80 transition">
                            Mulai Meminjam
                        </a>
                    </div>
                </div>
            </div>
        @else
        <div class="mx-auto">
            <div class="container items-start grid grid-cols-4 gap-6">
                <!-- Keranjang Section -->
                <div class="col-span-2 bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="w-full">
                        <table class="w-full">
                            <thead class="bg-unnes-blue border-b">
                                <tr>
                                    <th class="px-6 py-4 text-left text-md font-medium text-white">Barang</th>
                                    <th class="px-6 py-4 text-left text-md font-medium text-white">Kode</th>
                                    <th class="px-6 py-4 text-left text-md font-medium text-white">Letak</th>
                                    <th class="px-6 py-4 text-right text-m font-medium text-white">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($keranjangItems as $item)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-4">
                                                <img src="{{ asset('storage/' . $item->barang->gambar) }}" class="w-8 h-8 md:w-12 md:h-12 lg:w-16 lg:h-16 object-cover rounded-lg" alt="{{ $item->nama_barang }}">
                                                <span class="font-medium text-sm lg:text-md">{{ $item->nama_barang }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-gray-500 text-sm lg:text-md">{{ $item->kode_barang }}</td>
                                        <td class="px-6 py-4 text-gray-500 text-sm lg:text-md">{{ $item->letak_barang }}</td>
                                        <td class="px-6 py-4 text-right">
                                            <form action="{{ route('peminjam.keranjang.hapus', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="px-6 py-4 border-t border-gray-200">
                        <h2 class="text-md font-semibold">Ringkasan Peminjaman</h2>
                        <div class="space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Total Barang</span>
                                <span class="font-medium">{{ $keranjangItems->count() }} item</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="col-span-2">
                    <div class="bg-white rounded-lg shadow-md pt-3 p-6">
                        <h2 class="text-lg font-semibold mb-4 text-center">Form Peminjaman</h2>
                        <form action="{{ route('peminjam.keranjang.finalisasi') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
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
                            <button type="submit" class="bg-unnes-blue text-white text-sm rounded-lg px-4 py-2 mb-4 inline-block hover:bg-unnes-blue/80 w-full ">
                                Finalisasi Peminjaman
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('tanggal_dipinjam').value = today;
        });
    </script>
</x-app-layout>