<x-main-layout>
    <div class="">
        <div class="overflow-x-auto">
            <div class="container mx-auto px-4">
                @if($peminjamanList->isNotEmpty())
                <h1 class="text-2xl text-center font-bold pb-4 text-unnes-blue">DAFTAR PERMINTAAN</h1>
                <!-- Tabel Menunggu Persetujuan -->
                <div class="shadow-md rounded-lg overflow-hidden mb-4 bg-white">
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-300">
                            <thead class="text-white">
                                <tr class="bg-unnes-blue">
                                    <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Kode Barang</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Nama Barang</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Nama Peminjam</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Alamat</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Nomor Handphone</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Surat Tugas</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Tanggal Peminjaman</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Tanggal Pengembalian</th>
                                        <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($peminjamanList as $peminjaman)
                                <tr class="hover:bg-slate-100">
                                    <td class="px-6 py-3 text-left text-sm font-medium tracking-wider">{{ $peminjaman->kode_barang }}</td>
                                    <td class="px-6 py-3 text-left text-sm font-medium tracking-wider">{{ $peminjaman->nama_barang }}</td>
                                    <td class="px-6 py-3 text-left text-sm font-medium tracking-wider">{{ $peminjaman->nama_peminjam }}</td>
                                    <td class="px-6 py-3 text-left text-sm font-medium tracking-wider">{{ $peminjaman->alamat_peminjam }}</td>
                                    <td class="px-6 py-3 text-left text-sm font-medium tracking-wider">{{ $peminjaman->nomor_handphone }}</td>
                                    <td class="px-6 py-3 text-left text-sm font-medium tracking-wider">
                                        <div class="flex items-center justify-center space-x-2">
                                            @if(pathinfo($peminjaman->surat_tugas, PATHINFO_EXTENSION) == 'pdf')
                                                <a href="{{ asset('storage/' . $peminjaman->surat_tugas) }}" target="_blank" class="bg-unnes-blue text-white rounded h-8 w-8 flex items-center justify-center"><i class="fa-solid fa-eye"></i></a>
                                                <a href="{{ asset('storage/' . $peminjaman->surat_tugas) }}" download class="bg-unnes-yellow text-white rounded h-8 w-8 flex items-center justify-center"><i class="fa-solid fa-download"></i></a>
                                            @else
                                                <img src="{{ asset('storage/' . $peminjaman->surat_tugas) }}" alt="Surat Tugas" class="w-20 h-20 object-cover">
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-3 text-left text-sm font-medium tracking-wider">{{ $peminjaman->tanggal_peminjaman }}</td>
                                    <td class="px-6 py-3 text-left text-sm font-medium tracking-wider">{{ $peminjaman->tanggal_pengembalian }}</td>
                                    <td class="px-6 py-3 text-left text-sm font-medium tracking-wider">
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
                                <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Nama Peminjam</th>
                                <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Nomor Handphone</th>
                                <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Nama Barang</th>
                                <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Tanggal Peminjaman</th>
                                <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Tanggal Pengembalian</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($barangDipinjam as $barang)
                            <tr class="hover:bg-slate-100">
                                <td class="px-6 py-3 text-left text-sm font-medium tracking-wider">{{ $barang->nama_peminjam }}</td>
                                <td class="px-6 py-3 text-left text-sm font-medium tracking-wider">{{ $barang->nomor_handphone }}</td>
                                <td class="px-6 py-3 text-left text-sm font-medium tracking-wider">{{ $barang->nama_barang }}</td>
                                <td class="px-6 py-3 text-left text-sm font-medium tracking-wider">{{ $barang->tanggal_peminjaman }}</td>
                                <td class="px-6 py-3 text-left text-sm font-medium tracking-wider">{{ $barang->tanggal_pengembalian }}</td>
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
