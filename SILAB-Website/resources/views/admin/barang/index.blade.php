<x-main-layout>
    <div class="container mx-auto px-4 pb-4">
        <h1 class="text-xl text-center font-weight-bold py-4">INVENTARIS BARANG LABORATORIUM</h1>
        
        <!-- Form Pencarian -->
        <form method="GET" action="{{ route('admin.barang.index') }}" class="mb-4">
            <div class="input-group rounded">
                <input type="text" name="search" placeholder="Cari Nama Barang" value="{{ request('search') }}" class="form-control rounded-left">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-md btn-primary">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Form Filter -->
        <form method="GET" action="{{ route('admin.barang.index') }}" class="mb-4">
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label>Letak Barang:</label>
                        <select name="filter_letak" class="rounded" style="width: 100%;">
                            <option value="">Semua Letak</option>
                            @foreach($letakBarang as $letak)
                                <option value="{{ $letak->letak_barang }}" {{ request('filter_letak') == $letak->letak_barang ? 'selected' : '' }}>
                                    {{ $letak->letak_barang }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>Jenis Barang:</label>
                        <select name="filter_jenis" class="rounded" style="width: 100%;">
                            <option value="">Semua Jenis</option>
                            @foreach($jenisBarang as $jenis)
                                <option value="{{ $jenis->jenis_barang }}" {{ request('filter_jenis') == $jenis->jenis_barang ? 'selected' : '' }}>
                                    {{ $jenis->jenis_barang }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label>Kondisi Barang:</label>
                        <select name="filter_kondisi" class="rounded" style="width: 100%;">
                            <option value="">Semua Kondisi</option>
                            @foreach($kondisiBarang as $kondisi)
                                <option value="{{ $kondisi->kondisi_barang }}" {{ request('filter_kondisi') == $kondisi->kondisi_barang ? 'selected' : '' }}>
                                    {{ $kondisi->kondisi_barang }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-md btn-secondary">
                <i class="fa fa-filter"></i> Filter
            </button>
        </form>

        <a href="{{ route('admin.barang.create') }}" class="btn btn-primary mb-4">
            <i class="fas fa-plus"></i> Tambah Barang
        </a>

        <div class="card card-outline card-primary pb-6">
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Letak Barang</th>
                            <th>Jenis Barang</th>
                            <th>Gambar</th>
                            <th>Kondisi Barang</th>
                            <th>Status Barang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($barang as $item)
                            <tr>
                                <td>{{ $item->kode_barang }}</td>
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ $item->letak_barang }}</td>
                                <td>{{ $item->jenis_barang }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_barang }}" class="w-20 h-20 object-cover">
                                </td>
                                <td>{{ $item->kondisi_barang }}</td>
                                <td>{{ $item->status }}</td>
                                <td>
                                    <a href="{{ route('admin.barang.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('admin.barang.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-between align-items-center rounded p-4">
                    <div>
                        <form method="GET" action="{{ route('admin.barang.index') }}">
                            <!-- Tambahkan input hidden untuk mempertahankan filter dan pencarian -->
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <input type="hidden" name="filter_letak" value="{{ request('filter_letak') }}">
                            <input type="hidden" name="filter_jenis" value="{{ request('filter_jenis') }}">
                            <input type="hidden" name="filter_kondisi" value="{{ request('filter_kondisi') }}">
                            
                            <label for="perPage">Tampilkan:</label>
                            <select name="perPage" id="perPage" onchange="this.form.submit()" class="rounded ml-2">
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
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</x-main-layout>