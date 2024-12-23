<x-main-layout>
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center gap-4">
                <h1 class="text-2xl font-bold text-unnes-blue">Notifikasi</h1>
                <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                    {{ $notifikasi->where('is_read', false)->count() }} Baru
                </span>
            </div>
            <a href="{{ route('admin.notifikasi.create') }}" 
                class="bg-unnes-blue text-white px-4 py-2 rounded-lg hover:bg-unnes-blue/80 transition flex items-center gap-2">
                <i class="fas fa-plus"></i>
                <span>Kirim Pesan</span>
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-r">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md">
            <div class="p-4 border-b">
                <div class="flex gap-4">
                    <button class="px-4 py-2 text-sm font-medium rounded-lg bg-unnes-blue text-white">
                        Semua
                    </button>
                    <button class="px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 rounded-lg">
                        Belum Dibaca
                    </button>
                </div>
            </div>
            <ul class="divide-y">
                @foreach($notifikasi->sortByDesc('created_at') as $notif)
                    <li class="p-4 hover:bg-gray-50 transition-colors">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full bg-unnes-blue/10 flex items-center justify-center">
                                    <i class="fas fa-bell text-unnes-blue"></i>
                                </div>
                            </div>
                            <div class="flex-grow">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $notif->user->name }}</p>
                                        <p class="text-gray-600 mt-1">{{ $notif->message }}</p>
                                    </div>
                                    <div class="flex flex-col items-end gap-2">
                                        <span class="text-sm text-gray-500">{{ $notif->created_at->diffForHumans() }}</span>
                                        @if(!$notif->is_read)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                Baru
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-main-layout>