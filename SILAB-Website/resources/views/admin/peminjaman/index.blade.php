<x-main-layout>
    <div class="">
        <div class="overflow-x-auto">
            <div class="container mx-auto px-4">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                <div class="flex justify-between items-center mb-4">
                    <h1 class="text-2xl font-bold text-unnes-blue">DAFTAR PERMINTAAN</h1>
                    <a href="{{ route('admin.peminjaman.riwayat') }}" 
                       class="bg-unnes-blue text-white px-4 py-2 rounded-lg hover:bg-unnes-blue/80">
                        Lihat Riwayat
                    </a>
                </div>
                @if($peminjamanList->isNotEmpty())
                <h1 class="text-2xl text-center font-bold pb-4 text-unnes-blue">DAFTAR PERMINTAAN</h1>
                <!-- Tabel Menunggu Persetujuan -->
                <div class="shadow-md rounded-lg overflow-hidden mb-4 bg-white">
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-300">
                            <thead class="text-white">
                                <tr class="bg-unnes-blue">
                                    <th class="px-6 py-3 text-left text-sm font-medium">Kode Barang</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium">Nama Barang</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium">Nama Peminjam</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium">Alamat</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium">Nomor Handphone</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium">Surat Tugas</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium">Tanggal Peminjaman</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium">Tanggal Pengembalian</th>
                                        <th class="px-6 py-3 text-left text-sm font-medium">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($peminjamanList as $peminjaman)
                                <tr class="hover:bg-slate-100">
                                    <td class="px-6 py-3 text-left text-sm font-medium ">{{ $peminjaman->kode_barang }}</td>
                                    <td class="px-6 py-3 text-left text-sm font-medium ">{{ $peminjaman->nama_barang }}</td>
                                    <td class="px-6 py-3 text-left text-sm font-medium ">{{ $peminjaman->nama_peminjam }}</td>
                                    <td class="px-6 py-3 text-left text-sm font-medium ">{{ $peminjaman->alamat_peminjam }}</td>
                                    <td class="px-6 py-3 text-left text-sm font-medium ">{{ $peminjaman->nomor_handphone }}</td>
                                    <td class="px-6 py-3 text-left text-sm font-medium ">
                                        <div class="flex items-center justify-center space-x-2">
                                            @if(pathinfo($peminjaman->surat_tugas, PATHINFO_EXTENSION) == 'pdf')
                                                <a href="{{ asset('storage/' . $peminjaman->surat_tugas) }}" target="_blank" class="bg-unnes-blue text-white rounded h-8 w-8 flex items-center justify-center"><i class="fa-solid fa-eye"></i></a>
                                                <a href="{{ asset('storage/' . $peminjaman->surat_tugas) }}" download class="bg-unnes-yellow text-white rounded h-8 w-8 flex items-center justify-center"><i class="fa-solid fa-download"></i></a>
                                            @else
                                                <img src="{{ asset('storage/' . $peminjaman->surat_tugas) }}" alt="Surat Tugas" class="w-20 h-20 object-cover">
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-3 text-left text-sm font-medium ">{{ $peminjaman->tanggal_peminjaman }}</td>
                                    <td class="px-6 py-3 text-left text-sm font-medium ">{{ $peminjaman->tanggal_pengembalian }}</td>
                                    <td class="px-6 py-3 text-left text-sm font-medium ">
                                        <div class="flex items-center justify-center space-x-2">
                                            <form action="{{ route('admin.peminjaman.setujui', $peminjaman->id) }}" method="POST" class="inline">
                                                @csrf
                                            <button type="submit" class="bg-green-500 text-white rounded  h-8 w-8"><i class="fa-solid fa-circle-check"></i></button>
                                            </form>
                                            <form action="{{ route('admin.peminjaman.tolak', $peminjaman->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="bg-red-500 text-white rounded h-8 w-8"><i class="fa-solid fa-circle-xmark"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
        
                <!-- Tabel Barang Sedang Dipinjam -->
                @if($barangDipinjam->isNotEmpty())
                <h1 class="text-2xl text-center font-bold pb-4 text-unnes-blue">BARANG YANG DIPINJAM</h1>

                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <table class="w-full border-collapse border border-gray-300">
                        <thead class="text-white">
                            <tr class="bg-unnes-blue">
                                <th class="px-6 py-3 text-left text-sm font-medium ">Kode Barang</th>
                                <th class="px-6 py-3 text-left text-sm font-medium ">Nama Barang</th>
                                <th class="px-6 py-3 text-left text-sm font-medium ">Nama Peminjam</th>
                                <th class="px-6 py-3 text-left text-sm font-medium ">Nomor Handphone</th>
                                <th class="px-6 py-3 text-left text-sm font-medium ">Tanggal Peminjaman</th>
                                <th class="px-6 py-3 text-left text-sm font-medium ">Tanggal Pengembalian</th>
                                <th class="px-6 py-3 text-left text-sm font-medium ">Tandai Kembali</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($barangDipinjam as $barang)
                            <tr class="hover:bg-slate-100">
                                <td class="px-6 py-3 text-left text-sm font-medium ">{{ $barang->kode_barang }}</td>
                                <td class="px-6 py-3 text-left text-sm font-medium ">{{ $barang->nama_barang }}</td>
                                <td class="px-6 py-3 text-left text-sm font-medium ">{{ $barang->nama_peminjam }}</td>
                                <td class="px-6 py-3 text-left text-sm font-medium ">{{ $barang->nomor_handphone }}</td>
                                <td class="px-6 py-3 text-left text-sm font-medium ">{{ $barang->tanggal_peminjaman }}</td>
                                <td class="px-6 py-3 text-left text-sm font-medium ">{{ $barang->tanggal_pengembalian }}</td>
                                <td class="px-6 py-3 text-left text-sm font-medium ">
                                    <form action="{{ route('admin.peminjaman.konfirmasi-pengembalian', $barang->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin barang sudah dikembalikan?')">
                                        @csrf
                                        <button type="submit" class="bg-green-500 text-white rounded h-8 w-8 hover:bg-green-600">
                                            <i class="fa-solid fa-check"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-main-layout>
