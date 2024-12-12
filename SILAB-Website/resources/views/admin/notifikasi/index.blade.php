<x-main-layout>
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Pengaturan Notifikasi</h1>
            <a href="{{ route('admin.notifikasi.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                Kirim Pesan Baru
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <ul class="space-y-4">
            @foreach($notifikasi as $notif)
                <li class="border p-4 rounded">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-bold">Kepada: {{ $notif->user->name }}</p>
                            <p>{{ $notif->message }}</p>
                            <p class="text-sm text-gray-500">{{ $notif->created_at->diffForHumans() }}</p>
                        </div>
                        <span class="px-2 py-1 rounded {{ $notif->is_read ? 'bg-green-100' : 'bg-yellow-100' }}">
                            {{ $notif->is_read ? 'Terbaca' : 'Belum Terbaca' }}
                        </span>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</x-ma-layout>