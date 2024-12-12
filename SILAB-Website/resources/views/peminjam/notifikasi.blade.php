<x-app-layout>
    <x-navbar-header-user/>
    <div class="container flex mx-auto px-32 py-8 mt-12 pt-4">
        <a class="font-[Poppins] text-lg text-unnes-blue font-bold pt-10 pl-3 hover:text-unnes-blue/80" href="{{ route('peminjam.dashboard') }}">
            <i class="fa-solid fa-arrow-left"></i>Notifikasi</a>        
    </div>
    {{-- <div class="container flex mx-auto px-32 py-8 mt-12 pt-4">
        <a class="font-[Poppins] text-lg text-unnes-blue font-bold pt-10 pl-3 hover:text-unnes-blue/80" href="{{ route('peminjam.dashboard') }}">
            <i class="fa-solid fa-arrow-left"></i>Notifikasi</a>        
    </div>
    <!-- component -->
    <header class="container flex flex-col mx-auto shadow-md items-center justify-center px-32">
    <!-- logo -->

    <!-- navigation -->
    <nav class="nav font-semibold text-lg font-[Poppins]">
        <ul class="flex items-center justify-between w-full">
            <li class="p-4 flex-grow w-96 mx-10 text-center border-b-2 border-unnes-blue border-opacity-0 hover:border-opacity-100 hover:text-unnes-blue/80 duration-200 cursor-pointer active">
              <a href="">Semua</a>
            </li>
            <li class="p-4 flex-grow w-96 mx-10 text-center border-b-2 border-unnes-blue border-opacity-0 hover:border-opacity-100 hover:text-unnes-blue/80 duration-200 cursor-pointer">
              <a href="">Diajukan</a>
            </li>
            <li class="p-4 flex-grow w-96 mx-10 text-center border-b-2 border-unnes-blue border-opacity-0 hover:border-opacity-100 hover:text-unnes-blue/80 duration-200 cursor-pointer">
              <a href="">Diterima</a>
            </li>
        </ul>
    </nav>
</header>
<div class="container mx-auto flex gap-3 px-32 py-4 justify-center w-full h-full border-2 shadow-lg rounded-lg">
    <div class="flex items-center justify-start w-full"> <!-- Menambahkan items-center untuk sejajar -->
        <img src="{{ asset('assets/file.jpg') }}" class="w-12 h-12 ml-36 text-center">
        <p class=" text-[#211751] text-lg font-bold font-['Roboto'] ml-5">Surat Pengajuan Peminjaman Barang</p>
        <button class="px-4 py-2 rounded-lg flex bg-unnes-blue text-white hover:bg-unnes-blue/80 ml-[515px]"> <!-- Memindahkan tombol ke sini -->
            <a href="">Lihat Detail</a>
        </button>
    </div>
</div> --}}
<h1 class="text-center text-2xl font-bold my-6">Notifikasi</h1>
    <ul>
        @foreach($notifikasi as $notif)
            <li>
                {{ $notif->message }} - {{ $notif->is_read ? 'Terbaca' : 'Belum Terbaca' }}
                <form action="{{ route('notifikasi.markAsRead', $notif->id) }}" method="POST">
                    @csrf
                    <button type="submit">Tandai sebagai terbaca</button>
                </form>
            </li>
        @endforeach
    </ul>
</x-app-layout>