<header class="shadow-lg flex justify-between items-center bg-white w-full py-4 fixed top-0 px-4 md:px-8 lg:px-24 z-50">
    <div class="flex items-center">
        <img class="h-10 w-auto md:h-10" src="{{ asset('assets/Logo Silab.svg') }}" alt="Logo Silab">
        @auth
            @php
                $user = Auth::user();
                $initials = strtoupper(substr($user->name, 0, 1));
                $colors = ['bg-red-500', 'bg-green-500', 'bg-blue-500', 'bg-yellow-500', 'bg-purple-500'];
                $randomColor = $colors[array_rand($colors)];
            @endphp
        @endauth
    </div>
    <div class="flex-grow flex justify-center pr-4 md:pr-16 lg:pr-32">
    {{-- @props(['active', 'icon'])

            @php
            $classes = ($active ?? false)
                        ? 'p-2 mr-1 text-ungu  font-medium text-sm rounded-lg hover:text-ungu hover:bg-[#E6E2FF] dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600'
                        : 'p-2 mr-1 text-gray-400 text-sm rounded-lg hover:text-ungu hover:bg-[#E6E2FF] dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600 transition duration-150 ease-in-out';
            @endphp

            <a {{ $attributes->merge(['class' => $classes]) }}>
                {!! $icon !!}
                {{ $slot }}
            </a> --}}
            <nav class="flex gap-4 md:gap-8 lg:gap-16 items-center">
                @if (Auth::check() && Auth::user()->hasRole('peminjam'))
                <x-nav-link :href="route('peminjam.keranjang.index')" :active="request()->routeIs('peminjam.keranjang.index')">
                    <button class="text-sm md:text-md font-[Poppins] font-medium text-unnes-blue">
                        <i class="fa-solid fa-cart-shopping"></i> Keranjang
                    </button>
                </x-nav-link>
                <x-nav-link :href="route('peminjam.peminjaman.riwayat')" :active="request()->routeIs('peminjam.peminjaman.riwayat')">
                    <button class="text-sm md:text-md font-[Poppins] font-medium text-unnes-blue">
                        <i class="fa-solid fa-clock-rotate-left"></i> Riwayat
                    </button>
                </x-nav-link>
                <x-nav-link :href="route('peminjam.notifikasi.index')" :active="request()->routeIs('peminjam.notifikasi.index')">
                    <button class="text-sm md:text-md font-[Poppins] font-medium text-unnes-blue">
                        <i class="fa-solid fa-bell"></i> Notifikasi
                    </button>
                </x-nav-link>
                @endif
            </nav>
            @if(Auth::check() && Auth::user()->hasRole(['pemilik-facetro', 'pemilik-silab', 'pemilik-medunes', 'pemilik-sparka', 'pemilik-lms', 'pemilik-sentis', 'pemilik-melodi']))
            <nav class="flex gap-4 md:gap-8 lg:gap-16 items-center">
                <x-nav-link :href="route('peminjam.notifikasi.index')" :active="request()->routeIs('pemilik.tersedia.index')">
                    <button class="text-sm md:text-md font-[Poppins] font-medium text-unnes-blue"> Tersedia
                    </button>
                </x-nav-link>
                <x-nav-link :href="route('peminjam.notifikasi.index')" :active="request()->routeIs('pemilik.dipinjam.index')">
                    <button class="text-sm md:text-md font-[Poppins] font-medium text-unnes-blue"> Dipinjam
                    </button>
                </x-nav-link>
            </nav>
            @endif
    </div>
    <div>
        @auth
            <button id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start"class="text-white w-12 h-12 rounded-full font-medium text-base flex items-center justify-center {{ $randomColor }}">
                {{ $initials }}
            </button>
            <div id="userDropdown" class="z-10 text-sm text-gray-900 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
            <div class="px-4 py-3"><a href="">
            <div>{{ Auth::user()->name }}</div>
            <div class="font-medium truncate">{{ Auth::user()->email }}</div>
            </a>
            </div>
            <ul class="py-2" aria-labelledby="avatarButton">
            <li>
                <a href="#" class="block px-4 py-2 hover:bg-gray-300">Dashboard</a>
            </li>
            </ul>
            <div class="py-2 px-3 hover:bg-red-500 rounded-b-md">
                <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="nav-icon fas fa-sign-out-alt"></i>{{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    @else
        <a href="{{ route('login') }}" class="bg-unnes-blue text-white px-4 py-2 mx-2 rounded-full hover:bg-[#c3d1e6] hover:text-black text-md text-center">
            Login
        </a>

        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="border-2 border-unnes-b px-4 py-2 rounded-full hover:bg-unnes-blue hover:text-white text-md ">
                Register
            </a>
        @endif
    @endauth
                {{-- <ion-icon onclick="onToggleMenu(this)" name="menu-outline" class="text-2xl cursor-pointer md:hidden"></ion-icon> --}}
    </div>
</header>

{{-- DropDown --}}
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>