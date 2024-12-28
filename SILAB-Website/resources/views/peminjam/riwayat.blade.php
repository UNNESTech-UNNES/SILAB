<x-app-layout>
    <div class="container px-4 md:px-8 lg:px-32 mx-auto pt-16 md:pt-24 space-y-6">
        <x-title-header title="RIWAYAT PEMINJAMAN"/>

        <!-- Tab Navigation -->
        <div class="flex border-b-2 border-gray-200 w-full justify-between">
            <button onclick="changeTab('menunggu')" 
                    class="tab-btn flex justify-center w-full border-b-2 pb-4 border-unnes-blue text-unnes-blue" 
                    data-tab="menunggu">
                Menunggu Persetujuan
                <span class="bg-yellow-100 text-yellow-800 text-xs  font-medium px-2.5 py-1 rounded-full ml-2">
                    {{ $menungguPersetujuan->count() }}
                </span>
            </button>
            <button onclick="changeTab('dipinjam')" 
                    class="tab-btn flex justify-center w-full text-gray-400 border-b-2 pb-4 border-transparent" 
                    data-tab="dipinjam">
                Sedang Dipinjam
                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-1 rounded-full ml-2">
                    {{ $sedangDipinjam->count() }}
                </span>
            </button>
            <button onclick="changeTab('selesai')" 
                    class="tab-btn flex justify-center w-full text-gray-400 border-b-2 pb-4 border-transparent" 
                    data-tab="selesai">
                Selesai Dipinjam
                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-1 rounded-full ml-2">
                    {{ $riwayatSelesai->count() }}
                </span>
            </button>
        </div>

        <!-- Tab Content -->
        <div id="tab-content" class="flex flex-col w-full gap-4">
            @include('peminjam.partials.riwayat-content', ['items' => $menungguPersetujuan, 'tab' => 'menunggu'])
            @include('peminjam.partials.riwayat-content', ['items' => $sedangDipinjam, 'tab' => 'dipinjam'])
            @include('peminjam.partials.riwayat-content', ['items' => $riwayatSelesai, 'tab' => 'selesai'])
        </div>
    </div>

    @push('styles')
    <style>
        .tab-btn {
            @apply px-4 py-2 text-sm font-medium border-b-2 transition-colors duration-200;
        }
        .active-tab {
            @apply border-b-2 border-unnes-blue text-unnes-blue;
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        // Load initial content
        document.addEventListener('DOMContentLoaded', () => {
            loadTabContent('menunggu');
        });

        function changeTab(tabId) {
            // Update active tab styling
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('border-unnes-blue', 'text-unnes-blue');
                btn.classList.add('text-gray-400', 'border-transparent');
            });
            
            const activeTab = document.querySelector(`[data-tab="${tabId}"]`);
            activeTab.classList.remove('text-gray-400', 'border-transparent');
            activeTab.classList.add('border-unnes-blue', 'text-unnes-blue');

            // Load content
            loadTabContent(tabId);
        }

        function loadTabContent(tabId) {
            fetch(`/peminjam/riwayat/${tabId}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                document.getElementById('tab-content').innerHTML = html;
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
    @endpush
</x-app-layout>