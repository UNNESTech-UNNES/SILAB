<x-main-layout>
    <div class="container mx-auto px-4 pb-4">
        <h1 class="text-2xl text-center font-bold pb-4 text-unnes-blue">INVENTARIS BARANG LABORATORIUM</h1>
        
        <!-- Form Pencarian -->
        <form method="GET" action="{{ route('admin.barang.index') }}" class="mb-4 w-full">
            <div class="flex rounded-lg shadow-sm w-full items-center">
                <input type="text" name="search" placeholder="Cari Nama Barang" value="{{ request('search') }}" class="text-sm w-full form-control rounded-l-lg border border-gray-300 px-4 py-2 focus:outline-none focus:ring focus:ring-blue-500">
                <div class="relative">
                    <button type="submit" class="bg-unnes-blue text-white rounded-r-lg px-4 py-1.5">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Form Filter -->
        <form method="GET" action="{{ route('admin.barang.index') }}" class="mb-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                <div>
                    <label class="block mb-2">Letak Barang:</label>
                    <select name="filter_letak" class="rounded-lg border border-gray-300 w-full text-sm">
                        <option class="text-sm" value="">Semua Letak</option>
                        @foreach($letakBarang as $letak)
                            <option class="text-sm" value="{{ $letak->letak_barang }}" {{ request('filter_letak') == $letak->letak_barang ? 'selected' : '' }}>
                                {{ $letak->letak_barang }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block mb-2">Jenis Barang:</label>
                    <select name="filter_jenis" class="rounded-lg border border-gray-300 w-full text-sm">
                        <option class="text-sm" value="">Semua Jenis</option>
                        @foreach($jenisBarang as $jenis)
                            <option class="text-sm" value="{{ $jenis->jenis_barang }}" {{ request('filter_jenis') == $jenis->jenis_barang ? 'selected' : '' }}>
                                {{ $jenis->jenis_barang }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block mb-2">Kondisi Barang:</label>
                    <select name="filter_kondisi" class="rounded-lg border border-gray-300 w-full text-sm">
                        <option class="text-sm" value="">Semua Kondisi</option>
                        @foreach($kondisiBarang as $kondisi)
                            <option class="text-sm" value="{{ $kondisi->kondisi_barang }}" {{ request('filter_kondisi') == $kondisi->kondisi_barang ? 'selected' : '' }}>
                                {{ $kondisi->kondisi_barang }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="mt-4 bg-unnes-yellow text-white rounded-lg px-4 py-2 text-sm">
                <i class="fa fa-filter"></i> Filter
            </button>
        </form>

        <a href="{{ route('admin.barang.create') }}" class="bg-unnes-blue text-white text-sm rounded-lg px-4 py-2 mb-4 inline-block">
            <i class="fas fa-plus"></i> Tambah Barang
        </a>

        <div class="bg-white shadow-md rounded-lg pb-6 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="text-white">
                        <tr class="bg-unnes-blue">
                            <th class="px-6 py-3 text-left text-sm font-medium tracking-wider ">Kode Barang</th>
                            <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Nama Barang</th>
                            <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Letak Barang</th>
                            <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Jenis Barang</th>
                            <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Gambar</th>
                            <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Kondisi Barang</th>
                            <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Status Barang</th>
                            <th class="px-6 py-3 text-left text-sm font-medium tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($barang as $item)
                            <tr class="text-sm">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->kode_barang }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->nama_barang }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->letak_barang }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->jenis_barang }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_barang }}" class="w-20 h-20 object-cover">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->kondisi_barang }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->status }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('admin.barang.edit', $item->id) }}" class="bg-unnes-blue text-white rounded px-2 py-1">Edit</a>
                                    <form action="{{ route('admin.barang.destroy', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white rounded px-2 py-1">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="flex justify-between items-center p-4">
                    <div>
                        <form method="GET" action="{{ route('admin.barang.index') }}">
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <input type="hidden" name="filter_letak" value="{{ request('filter_letak') }}">
                            <input type="hidden" name="filter_jenis" value="{{ request('filter_jenis') }}">
                            <input type="hidden" name="filter_kondisi" value="{{ request('filter_kondisi') }}">
                            <label for="perPage" class="mr-2">Tampilkan:</label>
                            <select name="perPage" id="perPage" onchange="this.form.submit()" class="rounded border border-gray-300">
                                <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                                <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
                                <option value="30" {{ request('perPage') == 30 ? 'selected' : '' }}>30</option>
                                <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                            </select>
                        </form>
                    </div>
                    <div>
                        {{ $barang->appends(request()->except('page'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>