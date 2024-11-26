<x-main-layout>
    <div class="">
        <div class="overflow-x-auto">
            <div class="container mx-auto px-4">
                @if($peminjamanList->isNotEmpty())
                <h1 class="text-2xl text-center font-bold p-8 text-unnes-blue">DAFTAR PERMINTAAN</h1>
                <!-- Tabel Menunggu Persetujuan -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
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
                                <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($peminjamanList as $peminjaman)
                            <tr class="text-sm hover:bg-slate-100">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $peminjaman->kode_barang }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $peminjaman->nama_barang }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $peminjaman->nama_peminjam }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $peminjaman->alamat_peminjam }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $peminjaman->nomor_handphone }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if(pathinfo($peminjaman->surat_tugas, PATHINFO_EXTENSION) == 'pdf')
                                        <a href="{{ asset('storage/' . $peminjaman->surat_tugas) }}" target="_blank" class="text-blue-500 underline">Lihat PDF</a>
                                    @else
                                        <img src="{{ asset('storage/' . $peminjaman->surat_tugas) }}" alt="Surat Tugas" class="w-20 h-20 object-cover">
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $peminjaman->tanggal_peminjaman }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $peminjaman->tanggal_pengembalian }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $peminjaman->status }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ route('admin.peminjaman.setujui', $peminjaman->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-green-500 text-white rounded px-2 py-1">Setujui</button>
                                    </form>
                                    <form action="{{ route('admin.peminjaman.tolak', $peminjaman->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-red-500 text-white rounded px-2 py-1">Tolak</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
        
                <!-- Tabel Barang Sedang Dipinjam -->
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
            </div>
        </div>
    </div>
</x-main-layout>
