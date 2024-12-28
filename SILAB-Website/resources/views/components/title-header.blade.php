@props(['title'])

<div class="flex items-center justify-between">
    <a class="font-[Poppins] text-lg bg-unnes-blue font-bold w-10 h-10 rounded-lg flex items-center justify-center hover:bg-unnes-blue/60" href="{{ route('peminjam.dashboard') }}">
        <i class="fa-solid fa-arrow-left text-xl text-white"></i>
    </a>
    <h1 class="font-[Poppins] text-2xl text-unnes-blue font-bold">{{ $title }}</h1>
    <div class="opacity-0 font-[Poppins] text-lg bg-unnes-blue font-bold w-10 h-10 rounded-lg flex items-center justify-center hover:bg-unnes-blue/60">
        <i class="fa-solid fa-arrow-left text-xl text-white"></i>
    </div>
</div>