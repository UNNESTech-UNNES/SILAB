@forelse($items as $item)
    <div class="rounded-lg shadow p-4 flex justify-between items-center w-full ">
        <div class="flex gap-4 items-center">
            <img src="{{ asset('storage/' . $item->barang->gambar) }}" 
             class="w-48 h-32 object-cover rounded-lg" 
             alt="{{ $item->nama_barang }}">
            <div class="flex flex-col">
                <h3 class="font-semibold">{{ $item->nama_barang }}</h3>
                <p class="text-sm text-gray-500">{{ $item->kode_barang }}</p>
                <p class="text-sm text-gray-500">Ruang {{ $item->letak_barang }}</p>
            </div>
        </div>
        <div class="">
            @if($tab === 'menunggu')
            <div class="flex flex-col gap-2 justify-end items-end">
                <p class="text-sm text-gray-500">
                    Dipinjam: {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                </p>
                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-1 rounded-full">
                    Menunggu Persetujuan
                </span>
            </div>
            @elseif($tab === 'dipinjam')
            <div class="flex flex-col gap-2 justify-end items-end">
                <p class="text-sm text-gray-500 mt-2">
                    Dikembalikan: {{ \Carbon\Carbon::parse($item->tanggal_pengembalian)->format('d M Y') }}
                </p>
                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-1 rounded-full">
                    Sedang Dipinjam
                </span>
            </div>
            @else
            <div class="flex flex-col gap-2 justify-end items-end">
                <p class="text-sm text-gray-500 mt-2">
                    <i class="fas fa-calendar-check text-green-500"></i>
                    Dikembalikan: {{ \Carbon\Carbon::parse($item->tanggal_dikembalikan)->format('d M Y') }}
                </p>
                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-1 rounded-full">
                    Selesai
                </span>
            </div>
        @endif
        </div>
    </div>
@empty
    <div class="col-span-3 bg-white p-4 text-center text-gray-500">
        Tidak ada data untuk ditampilkan
    </div>
@endforelse 