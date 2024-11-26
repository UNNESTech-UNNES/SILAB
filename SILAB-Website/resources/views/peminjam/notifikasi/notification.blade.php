<x-app-layout>
    <x-navbar-header-user/>
    <div class="container flex mx-auto px-32 py-8 mt-12 pt-4">
        <a class="font-[Poppins] text-lg text-unnes-blue font-bold pt-10 pl-3 hover:text-unnes-blue/80" href="{{ route('peminjam.dashboard') }}">
            <i class="fa-solid fa-arrow-left"></i>Notifikasi</a>        
    </div>
    <!-- component -->
    <header class="container flex mx-auto bg-white shadow-md items-center justify-center px-32">
    <!-- logo -->

    <!-- navigation -->
    <nav class="nav font-semibold text-lg font-[Poppins] px-32">
        <ul class="flex items-center justify-between w-full">
            <li class="p-4 flex-grow mx-44 text-center border-b-2 border-unnes-blue border-opacity-0 hover:border-opacity-100 hover:text-unnes-blue/80 duration-200 cursor-pointer active">
              <a href="">Semua</a>
            </li>
            <li class="p-4 flex-grow mx-44 text-center border-b-2 border-unnes-blue border-opacity-0 hover:border-opacity-100 hover:text-unnes-blue/80 duration-200 cursor-pointer">
              <a href="">Diajukan</a>
            </li>
            <li class="p-4 flex-grow mx-44 text-center border-b-2 border-unnes-blue border-opacity-0 hover:border-opacity-100 hover:text-unnes-blue/80 duration-200 cursor-pointer">
              <a href="">Diterima</a>
            </li>
        </ul>
    </nav>
</header>
  <div class="container flex mx-auto w-full h-full gap-3 px-32 py-4 justify-center">
    <img src="{{ asset('assets/file.jpg') }}" class="w-12 h-12">
    <p class="text-[#211751] text-lg font-bold font-['Roboto']">Surat Pengajuan Peminjaman Barang</p>
    <button class=" ml-96 px-4 py-2 rounded-lg items-center inline-flex bg-unnes-blue text-white hover:bg-unnes-blue/80">
        <a href="">Lihat Detail</a></button>
  </div>
</x-app-layout>