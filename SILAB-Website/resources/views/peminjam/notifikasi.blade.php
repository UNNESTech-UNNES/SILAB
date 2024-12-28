<x-app-layout>
    
    <div class="container px-4 md:px-8 lg:px-32 mx-auto pt-16 md:pt-24 space-y-6">
        <x-title-header title="NOTIFIKASI" />
        @if($notifikasi->isEmpty())
            <div class="container mx-auto pt-24">
                <div class="p-8 text-center">
                    <div class="flex flex-col items-center gap-4">
                        <i class="fas fa-bell text-9xl text-gray-300"></i>
                        <h2 class="text-2xl font-semibold text-gray-600">Tidak ada notifikasi</h2>
                        <p class="text-gray-500">Anda belum memiliki notifikasi</p>
                        <a href="{{ route('peminjam.dashboard') }}" class="bg-unnes-blue text-white px-6 py-2 rounded-lg hover:bg-unnes-blue/80 transition">
                            Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        @else
        <div class="space-y-4">
            @foreach($notifikasi->sortByDesc('created_at') as $notif)
                <div class="bg-white rounded-lg shadow-md p-4 flex items-center justify-between hover:bg-gray-50 transition-colors">
                    <div class="flex items-start gap-4 flex-grow">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 rounded-full bg-unnes-blue/10 flex items-center justify-center">
                                <i class="fas fa-bell text-unnes-blue"></i>
                            </div>
                        </div>
                        <div class="flex-grow">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-gray-600">{{ $notif->message }}</p>
                                    <p class="text-sm text-gray-400 mt-1">{{ $notif->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @if(!$notif->is_read)
                        <form action="{{ route('notifikasi.markAsRead', $notif->id) }}" method="POST" class="ml-4">
                            @csrf
                            <button type="submit" 
                                class="text-sm px-3 py-1.5 rounded-lg text-unnes-blue bg-unnes-blue/10 hover:bg-unnes-blue/20 transition-colors">
                                Tandai dibaca
                            </button>
                        </form>
                    @else
                        <span class="text-sm text-gray-400 ml-4">Telah dibaca</span>
                    @endif
                </div>
            @endforeach
        </div>
        @endif
    </div>
</x-app-layout>