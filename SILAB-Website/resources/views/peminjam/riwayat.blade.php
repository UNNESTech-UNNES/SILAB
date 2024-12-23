<x-app-layout>
    <div class="container flex mx-auto px-32 py-8 mt-12 pt-4">
        <a class="font-[Poppins] text-lg text-unnes-blue font-bold pt-10 pl-3 hover:text-unnes-blue/60" href="{{ route('peminjam.dashboard') }}">
            <i class="fa-solid fa-arrow-left"></i>Kembali</a>        
    </div>
    <div class="container flex flex-col mx-auto items-center justify-center px-32 w-[1250px]">
        <h1 class="text-2xl font-bold pt-5 font-[Poppins] text-center mb-3 text-black">Riwayat Peminjaman</h1>
    </div>
    <button class="text-md font-bold font-[Poppins] text-end my-3 mx-60 text-gray-400 bg-white" href="...">Bersihkan semua</button>
    <div class="container flex rounded-lg shadow-lg justify-start px-3 mx-auto w-[1250px] overflow-hidden hover:-translate-y-1 transition mt-5">
        {{-- <div class="p-3 flex justify-between">
            <img class="w-52 h-32 object-cover rounded-lg" src="{{ asset('assets/keyboardasus.jpg') }}" alt="Gambar Barang" />
            <div class="flex flex-col mx-5 w-44 h-32">
                <h3 class="text-black text-xl font-semibold">Keyboard ASUS</h3>
                <div class="text-gray-500 text-xs font-semibold">Ruang 1A</div>
                <div class="bg-red-600 rounded-lg w-16 h-4 flex justify-center gap-1 mt-12">
                    <span class="text-white text-xs text-center">Selesai</span>
                </div>
            </div>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger flex ml-[750px] justify-items-end text-3xl text-gray-400 w-10 h-10" href="...">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div> --}}
    </div>
    {{-- <div class="container flex rounded-lg shadow-lg justify-start px-3 mx-auto w-[1250px] overflow-hidden hover:-translate-y-1 transition mt-5">
        <div class="p-3 flex justify-between">
            <img class=" w-52 h-32 object-cover rounded-lg" src="{{ asset('assets/monitorasus1.png') }}" alt="Gambar Barang" />
            <div class="flex flex-col mx-5 w-44 h-32">
                <h3 class="text-black text-xl font-semibold">Monitor ASUS</h3>
                <div class="text-gray-500 text-xs font-semibold">Ruang 1B</div>
                <div class="bg-red-600 rounded-lg w-16 h-4 flex justify-center gap-1 mt-12">
                    <span class="text-white text-xs text-center">Selesai</span>
                </div>
            </div>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger flex ml-[750px] justify-items-end text-3xl text-gray-400 w-10 h-10" href="...">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    </div> --}}
    {{-- <div class="container flex rounded-lg shadow-lg justify-start px-3 mx-auto w-[1250px] overflow-hidden hover:-translate-y-1 transition mt-5">
        <div class="p-3 flex justify-between">
            <img class=" w-52 h-32 object-cover rounded-lg" src="{{ asset('assets/keyboardasus.jpg') }}" alt="Gambar Barang" />
            <div class="flex flex-col mx-5 w-44 h-32">
                <h3 class="text-black text-xl font-semibold">Keyboard ASUS</h3>
                <div class="text-gray-500 text-xs font-semibold">Ruang 1A</div>
                <div class="bg-red-600 rounded-lg w-16 h-4 flex justify-center gap-1 mt-12">
                    <span class="text-white text-xs text-center">Selesai</span>
                </div>
            </div>
            <button class="flex ml-[750px] justify-items-end text-3xl text-gray-400 w-10 h-10">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    </div> --}}
</x-app-layout>