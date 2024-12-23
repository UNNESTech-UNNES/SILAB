<x-app-layout>
    <div class="mt-24">
        <a class="font-[Poppins] text-lg text-unnes-blue font-bold pl-32 py-8 hover:text-unnes-blue/60" href="{{ route('peminjam.dashboard') }}">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>

        @if($keranjangItems->isEmpty())
            <div class="container mx-auto px-32 py-10">
                <div class="bg-white rounded-lg p-8 text-center">
                    <div class="flex flex-col items-center gap-4">
                        <i class="fas fa-shopping-cart text-6xl text-gray-300"></i>
                        <h2 class="text-2xl font-semibold text-gray-600">Keranjang Kosong</h2>
                        <p class="text-gray-500">Anda belum menambahkan barang ke keranjang</p>
                        <a href="{{ route('peminjam.dashboard') }}" class="bg-unnes-blue text-white px-6 py-2 rounded-lg hover:bg-unnes-blue/80 transition">
                            Mulai Meminjam
                        </a>
                    </div>
                </div>
            </div>
        @else
        <div class="mx-auto px-32">
            <h1 class="text-2xl font-bold mb-6 pl-80">Keranjang Peminjaman</h1>
            <div class="container items-start  py-1 grid grid-cols-3 gap-6">
                <!-- Keranjang Section -->
                <div class="col-span-2">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-medium text-gray-500">Barang</th>
                                    <th class="px-6 py-4 text-left text-sm font-medium text-gray-500">Kode</th>
                                    <th class="px-6 py-4 text-left text-sm font-medium text-gray-500">Letak</th>
                                    <th class="px-6 py-4 text-right text-sm font-medium text-gray-500">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($keranjangItems as $item)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-4">
                                                <img src="{{ asset('storage/' . $item->barang->gambar) }}" class="w-16 h-16 object-cover rounded-lg" alt="{{ $item->nama_barang }}">
                                                <span class="font-medium">{{ $item->nama_barang }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-gray-500">{{ $item->kode_barang }}</td>
                                        <td class="px-6 py-4 text-gray-500">{{ $item->letak_barang }}</td>
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
                    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                        <h2 class="text-lg font-semibold mb-4">Ringkasan Peminjaman</h2>
                        <div class="space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Total Barang</span>
                                <span class="font-medium">{{ $keranjangItems->count() }} item</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="col-span-1">
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