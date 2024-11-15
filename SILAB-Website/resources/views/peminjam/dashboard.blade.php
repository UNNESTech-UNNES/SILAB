<<<<<<< HEAD
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
        <header class="shadow-lg flex justify-between items-center bg-white w-full px-4 py-2">
            <div class="flex items-center gap-3">
                <img class="h-12 w-auto" src="{{ asset('assets/Logo Silab.svg') }}" alt="Logo Silab">
                @php
                $user = Auth::user();
                $initials = strtoupper(substr($user->name, 0, 1));
                $colors = ['bg-red-500', 'bg-green-500', 'bg-blue-500', 'bg-yellow-500', 'bg-purple-500'];
                $randomColor = $colors[array_rand($colors)];
                @endphp
                <div class="text-black thic">
                    <h1 class="text-lg">Selamat Datang, {{ Auth::user()->name }} </h1>
                </div>
            </div>
            <div>
                <button id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start"class=" text-white w-12 h-12 rounded-full font-medium text-base flex items-center justify-center {{ $randomColor }}">
                    {{ $initials }}
                </button>
                <div id="userDropdown" class="z-0 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                    <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                      <div>{{ Auth::user()->name }}</div>
                      <div class="font-medium truncate">{{ Auth::user()->email }}</div>
                    </div>
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="avatarButton">
                      <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                      </li>
                      <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                      </li>

                    </ul>
                    <div class="py-2 text-white text-sm px-4">
                            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    {{ __('Logout') }}
                                </p>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                </div>
            </div>
        </header>
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    
        <section class="bg-white pt-8">
=======
<x-app-layout>
    <x-navbar-header-user/>
        <section class="py-8 z-0">
>>>>>>> 5013c849b09e9dd2ef9f7d45dab68bbf1d6a0e33
            <div class="container mx-auto flex items-center flex-wrap">
                <x-list-barang :barangs="$barangs"/>
                <a href="{{ route('peminjam.keranjang.index') }}" class="btn btn-primary">Lihat Keranjang</a>
            </div>
        </section>

        <script>
            document.getElementById('searchButton').addEventListener('click', function() {
                const query = document.getElementById('searchInput').value;
                if (query) {
                    // Lakukan pencarian atau kirimkan query ke server
                    console.log('Mencari:', query);
                    // Contoh: Anda bisa mengarahkan ke URL pencarian
                    // window.location.href = `/search?query=${encodeURIComponent(query)}`;
                } else {
                    alert('Silakan masukkan kata kunci pencarian.');
                }
            });
        </script>
        <script>
            const navLinks = document.querySelector('.nav-links');
            function onToggleMenu(e) {
                e.name = e.name === 'menu' ? 'close' : 'menu';
                navLinks.classList.toggle('top-[9%]');
            }
        </script>
<<<<<<< HEAD
    </body>
</html> 
=======
</x-app-layout>
>>>>>>> 5013c849b09e9dd2ef9f7d45dab68bbf1d6a0e33
