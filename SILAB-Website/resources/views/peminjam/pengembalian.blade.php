<x-app-layout>
    <x-navbar-header-user/>
    <div class="container flex mx-auto px-32 py-8 mt-12 pt-4">
        <a class="font-[Poppins] text-lg text-unnes-blue font-bold pt-10 pl-3 hover:text-unnes-blue/80" href="{{ route('peminjam.dashboard') }}">
            <i class="fa-solid fa-arrow-left"></i>Kembali</a>        
    </div>
    <div class="container flex flex-col mx-auto shadow-md items-center justify-center px-32 w-[1250px]">
        <h1 class="text-2xl font-bold pt-5 font-[Poppins] text-center mb-3 text-unnes-blue">Barang Anda</h1>
    </div>
    <div class="container flex rounded-lg shadow-lg justify-start px-3 mx-auto w-[1250px] overflow-hidden hover:-translate-y-1 transition mt-5">
        <div class="p-3 flex justify-between">
            <img class=" w-52 h-32 object-cover rounded-lg" src="{{ asset('assets/keyboardasus.jpg') }}" alt="Gambar Barang" />
            <div class="flex flex-col mx-5">
                <h3 class="text-black text-xl font-semibold w-40">Keyboard ASUS</h3>
                <div class="text-gray-500 text-xs font-semibold">Ruang 1A</div>
                <div class="bg-unnes-yellow rounded-full w-32 h-4 flex justify-center gap-1 mt-12">
                    <span class="text-black text-xs text-center font-semibold">Sedang Dipinjam</span>
                </div>
            </div>
            <button class="px-4 py-2 rounded-full flex bg-unnes-blue text-white hover:bg-unnes-blue/80 ml-[670px] w-32 h-10 text-center mt-20"> <!-- Memindahkan tombol ke sini -->
                <a href="">Kembalikan</a>
            </button>
        </div>
    </div>
</x-app-layout>