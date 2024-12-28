<x-app-layout>
    <div class="container flex mx-auto px-4 md:px-16 lg:px-32 py-8 mt-12 pt-4">
        <a class="font-[Poppins] text-base md:text-lg text-unnes-blue font-bold pt-10 pl-3 hover:text-unnes-blue/60" href="{{ route('peminjam.dashboard') }}">
            <i class="fa-solid fa-arrow-left"></i>Kembali</a>        
    </div>

    <div class="container mx-auto px-4 md:px-16 lg:px-32">
        <h1 class="text-xl md:text-2xl font-bold mb-6 text-unnes-blue text-center">Notifikasi</h1>
        
        <div class="space-y-4">
            @foreach($notifikasi->sortByDesc('created_at') as $notif)
                <div class="bg-white rounded-lg shadow-md p-4 flex flex-col md:flex-row items-start md:items-center justify-between hover:bg-gray-50 transition-colors">
                    <div class="flex items-start gap-4 flex-grow">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 rounded-full bg-unnes-blue/10 flex items-center justify-center">
                                <i class="fas fa-bell text-unnes-blue"></i>
                            </div>
                        </div>
                        <div class="flex-grow">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-sm md:text-base text-gray-600">{{ $notif->message }}</p>
                                    <p class="text-xs md:text-sm text-gray-400 mt-1">{{ $notif->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @if(!$notif->is_read)
                        <form action="{{ route('notifikasi.markAsRead', $notif->id) }}" method="POST" class="mt-2 md:mt-0 md:ml-4">
                            @csrf
                            <button type="submit" 
                                class="text-xs md:text-sm px-2 md:px-3 py-1 md:py-1.5 rounded-lg text-unnes-blue bg-unnes-blue/10 hover:bg-unnes-blue/20 transition-colors">
                                Tandai dibaca
                            </button>
                        </form>
                    @else
                        <span class="text-xs md:text-sm text-gray-400 mt-2 md:mt-0 md:ml-4">Telah dibaca</span>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>