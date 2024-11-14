<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SILAB-WEB</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search" />
    <!-- CAROUSEL -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body class="font-[Poppins] bg-white">
    <header class="flex justify-between items-center bg- shadow-lg w-full px-4 py-2">
        <div class="flex items-center gap-2">
            <img class="h-12 w-auto" src="assets/Logo Silab.svg" alt="">
        </div>

        @if (Route::has('login'))
            <nav class="flex gap-2">
                @auth
                    <a href="{{ route('peminjam.dashboard') }}" class="bg-[#00007f] text-white px-3 py-1.5 rounded-full hover:bg-[#c3d1e6] hover:text-black text-sm">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="bg-[#00007f] text-white px-3 py-1.5 rounded-full hover:bg-[#c3d1e6] hover:text-black text-sm">
                        Login
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-[#00007f] text-white px-3 py-1.5 rounded-full hover:bg-[#c3d1e6] hover:text-black text-sm">
                            Register
                        </a>
                    @endif
                @endauth
                <ion-icon onclick="onToggleMenu(this)" name="menu-outline" class="text-2xl cursor-pointer md:hidden"></ion-icon>
            </nav>
        @endif
    </header>
    <div class="container flex flex-col justify-center items-center mx-auto px-32">
        <div id="default-carousel" class="relative w-full rounded-md" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden md:h-96">
                <!-- Item 1 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="assets/Group 67.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="assets/Group 68.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 3 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="assets/Group 69.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>


    <section class="bg-white">
        <div class="container mx-auto flex items-center flex-wrap">
            <div class="w-full text-center">
                <h2 class="font-[Poppins] text-[#00007f] text-2xl font-bold">DAFTAR BARANG</h2>
            </div>
            <div class="container z-30 top-0 px-32 pt-4">
                <div class="relative flex items-center bg-slate-100">
                    <input class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pr-3 pl-4 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" placeholder="Cari barang..." />
                    <button class="rounded-md ml-2 bg-[#00007f] p-2.5 border border-transparent text-center text-sm text-white transition-all shadow-sm hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                            <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
            <nav className="sticky top-0 z-10 bg-white">
                <div className="max-w-5xl mx-auto">
                    <div class="container z-30 top-0 px-32 pt-8 text-slate-500 text-sm">
                      <a href="#" class="rounded-full border-2 px-3 py-1.5 hover:bg-[#00007f] hover:text-white">All</a>
                      <a href="#" class="rounded-full border-2 px-3 py-1.5 hover:bg-[#00007f] hover:text-white">Ruang 1A</a>
                      <a href="#" class="rounded-full border-2 px-3 py-1.5 hover:bg-[#00007f] hover:text-white">Ruang 1B</a>
                      <a href="#" class="rounded-full border-2 px-3 py-1.5 hover:bg-[#00007f] hover:text-white">Ruang 1C</a>
                      <a href="#" class="rounded-full border-2 px-3 py-1.5 hover:bg-[#00007f] hover:text-white">Ruang 1D</a>
                      <a href="#" class="rounded-full border-2 px-3 py-1.5 hover:bg-[#00007f] hover:text-white">Ruang 2A</a>
                      <a href="#" class="rounded-full border-2 px-3 py-1.5 hover:bg-[#00007f] hover:text-white">Ruang 2B</a>
                      <a href="#" class="rounded-full border-2 px-3 py-1.5 hover:bg-[#00007f] hover:text-white">Ruang 2C</a>
                      <a href="#" class="rounded-full border-2 px-3 py-1.5 hover:bg-[#00007f] hover:text-white">Ruang 2D</a>
                    </div>
                </div>
            </nav>
            <div class="container mx-auto px-32 py-10">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Card Item -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="p-3">
                          <img class="w-full h-32 object-cover rounded-lg" src="{{ asset('assets/monitorasus1.png') }}" />
                            <div class="mt-3 space-y-2">
                                <div class="flex justify-between items-center">
                                    <div class="px-2 py-0.5 bg-[#ffd900] rounded-lg">
                                        <div class="flex items-center gap-1">
                                            <span class="text-[#1a1a1a] text-xs font-semibold">Tersedia</span>
                                            <span class="text-[#1a1a1a] text-sm font-semibold">10/15</span>
                                        </div>
                                    </div>
                                    <div class="text-[#999999] text-xs">Ruang 1B</div>
                                </div>
                                <div class="space-y-1">
                                    <h3 class="text-black text-sm font-semibold">Monitor ASUS</h3>
                                    <p class="text-[#999999] text-xs line-clamp-2">Monitor dengan resolusi FHD dengan ukuran 16 inch</p>
                                </div>
                                <button class="w-full py-1.5 px-3 bg-[#00007f] hover:bg-[#c3d1e6] hover:text-black text-white text-xs rounded-full transition-colors duration-200 font-semibold">
                                    Pinjam
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Card Item -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="p-3">
                          <img class="w-full h-32 object-cover rounded-lg" src="{{ asset('assets/monitorasus1.png') }}" />
                            <div class="mt-3 space-y-2">
                                <div class="flex justify-between items-center">
                                    <div class="px-2 py-0.5 bg-[#ffd900] rounded-lg">
                                        <div class="flex items-center gap-1">
                                            <span class="text-[#1a1a1a] text-xs font-semibold">Tersedia</span>
                                            <span class="text-[#1a1a1a] text-sm font-semibold">10/15</span>
                                        </div>
                                    </div>
                                    <div class="text-[#999999] text-xs">Ruang 1B</div>
                                </div>
                                <div class="space-y-1">
                                    <h3 class="text-black text-sm font-semibold">Monitor ASUS</h3>
                                    <p class="text-[#999999] text-xs line-clamp-2">Monitor dengan resolusi FHD dengan ukuran 16 inch</p>
                                </div>
                                <button class="w-full py-1.5 px-3 bg-[#00007f] hover:bg-[#c3d1e6] hover:text-black text-white text-xs rounded-full transition-colors duration-200 font-semibold">
                                    Pinjam
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Card Item -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="p-3">
                          <img class="w-full h-32 object-cover rounded-lg" src="{{ asset('assets/monitorasus1.png') }}" />
                            <div class="mt-3 space-y-2">
                                <div class="flex justify-between items-center">
                                    <div class="px-2 py-0.5 bg-[#ffd900] rounded-lg">
                                        <div class="flex items-center gap-1">
                                            <span class="text-[#1a1a1a] text-xs font-semibold">Tersedia</span>
                                            <span class="text-[#1a1a1a] text-sm font-semibold">10/15</span>
                                        </div>
                                    </div>
                                    <div class="text-[#999999] text-xs">Ruang 1B</div>
                                </div>
                                <div class="space-y-1">
                                    <h3 class="text-black text-sm font-semibold">Monitor ASUS</h3>
                                    <p class="text-[#999999] text-xs line-clamp-2">Monitor dengan resolusi FHD dengan ukuran 16 inch</p>
                                </div>
                                <button class="w-full py-1.5 px-3 bg-[#00007f] hover:bg-[#c3d1e6] hover:text-black text-white text-xs rounded-full transition-colors duration-200 font-semibold">
                                    Pinjam
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Card Item -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="p-3">
                          <img class="w-full h-32 object-cover rounded-lg" src="{{ asset('assets/monitorasus1.png') }}" />
                            <div class="mt-3 space-y-2">
                                <div class="flex justify-between items-center">
                                    <div class="px-2 py-0.5 bg-[#ffd900] rounded-lg">
                                        <div class="flex items-center gap-1">
                                            <span class="text-[#1a1a1a] text-xs font-semibold">Tersedia</span>
                                            <span class="text-[#1a1a1a] text-sm font-semibold">10/15</span>
                                        </div>
                                    </div>
                                    <div class="text-[#999999] text-xs">Ruang 1B</div>
                                </div>
                                <div class="space-y-1">
                                    <h3 class="text-black text-sm font-semibold">Monitor ASUS</h3>
                                    <p class="text-[#999999] text-xs line-clamp-2">Monitor dengan resolusi FHD dengan ukuran 16 inch</p>
                                </div>
                                <button class="w-full py-1.5 px-3 bg-[#00007f] hover:bg-[#c3d1e6] hover:text-black text-white text-xs rounded-full transition-colors duration-200 font-semibold">
                                    Pinjam
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        const navLinks = document.querySelector('.nav-links');
        function onToggleMenu(e) {
            e.name = e.name === 'menu' ? 'close' : 'menu';
            navLinks.classList.toggle('top-[9%]');
        }
    </script>
</body>
</html>