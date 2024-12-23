<x-main-layout>
    <div class="container mx-auto px-4">
        <!-- Grafik Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <!-- Grafik Barang Terpopuler -->
            <div class="bg-white shadow-md rounded-lg p-4">
                <h2 class="text-xl font-bold text-unnes-blue mb-4">Barang Terbanyak Dipinjam</h2>
                <canvas id="popularItemsChart"></canvas>
            </div>
            
            <!-- Grafik Timeline Peminjaman -->
            <div class="bg-white shadow-md rounded-lg p-4">
                <h2 class="text-xl font-bold text-unnes-blue mb-4">Timeline Peminjaman</h2>
                <canvas id="timelineChart"></canvas>
            </div>
        </div>

        <!-- Rekapitulasi Barang -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-unnes-blue mb-4 text-center">REKAPITULASI BARANG</h2>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-unnes-blue text-white">
                        <tr>
                            <th class="px-6 py-3 text-left">Nama Barang</th>
                            <th class="px-6 py-3 text-left">Lokasi</th>
                            <th class="px-6 py-3 text-left">Jumlah Total</th>
                            <th class="px-6 py-3 text-left">Tersedia</th>
                            <th class="px-6 py-3 text-left">Dipinjam</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($rekapBarang as $rekap)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $rekap->nama_barang }}</td>
                            <td class="px-6 py-4">{{ $rekap->letak_barang }}</td>
                            <td class="px-6 py-4">{{ $rekap->total }}</td>
                            <td class="px-6 py-4">{{ $rekap->tersedia }}</td>
                            <td class="px-6 py-4">{{ $rekap->dipinjam }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Barang Yang Harus Segera Dikembalikan -->
        <div>
            <h2 class="text-2xl font-bold text-unnes-blue mb-4 text-center">HARUS SEGERA DIKEMBALIKAN</h2>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-unnes-blue text-white">
                        <tr>
                            <th class="px-6 py-3 text-left">Nama Barang</th>
                            <th class="px-6 py-3 text-left">Peminjam</th>
                            <th class="px-6 py-3 text-left">Tanggal Pinjam</th>
                            <th class="px-6 py-3 text-left">Tanggal Kembali</th>
                            <th class="px-6 py-3 text-left">Sisa Hari</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($segeraKembali as $peminjaman)
                        <tr class="hover:bg-gray-50 {{ $peminjaman->sisa_hari <= 3 ? 'text-red-500' : '' }}">
                            <td class="px-6 py-4">{{ $peminjaman->nama_barang }}</td>
                            <td class="px-6 py-4">{{ $peminjaman->nama_peminjam }}</td>
                            <td class="px-6 py-4">{{ $peminjaman->tanggal_peminjaman }}</td>
                            <td class="px-6 py-4">{{ $peminjaman->tanggal_pengembalian }}</td>
                            <td class="px-6 py-4">{{ $peminjaman->sisa_hari }} hari</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        // Data dari controller
        const popularItems = {!! json_encode($popularItems) !!};
        const timelineData = {!! json_encode($timelinePeminjaman) !!};

        // Grafik Barang Terpopuler
        new Chart(document.getElementById('popularItemsChart'), {
            type: 'bar',
            data: {
                labels: popularItems.map(item => item.nama_barang),
                datasets: [{
                    label: 'Jumlah Peminjaman',
                    data: popularItems.map(item => item.total_peminjaman),
                    backgroundColor: '#1e40af'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });

        // Grafik Timeline
        new Chart(document.getElementById('timelineChart'), {
            type: 'line',
            data: {
                labels: timelineData.map(item => item.tanggal),
                datasets: [{
                    label: 'Jumlah Peminjaman Aktif',
                    data: timelineData.map(item => item.jumlah_peminjaman),
                    borderColor: '#1e40af',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>
</x-main-layout>