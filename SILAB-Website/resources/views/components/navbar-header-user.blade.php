<header class="shadow-lg flex justify-between items-center bg-white w-full py-2 fixed top-0 px-24 z-50">
    <div class="flex items-center">
        <img class="h-12 w-auto" src="{{ asset('assets/Logo Silab.svg') }}" alt="Logo Silab">
        @auth
            @php
                $user = Auth::user();
                $initials = strtoupper(substr($user->name, 0, 1));
                $colors = ['bg-red-500', 'bg-green-500', 'bg-blue-500', 'bg-yellow-500', 'bg-purple-500'];
                $randomColor = $colors[array_rand($colors)];
            @endphp
        @endauth
    </div>
    <div>
        @if (Route::has('login'))
            <nav class="flex gap-2">
                @auth
                    <button id="avatarButton" type="button" data-dropdown-toggle="userDropdown" data-dropdown-placement="bottom-start"class="text-white w-12 h-12 rounded-full font-medium text-base flex items-center justify-center {{ $randomColor }}">
                        {{ $initials }}
                    </button>
                    <div id="userDropdown" class="z-10 text-sm text-gray-900 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                        <div class="px-4 py-3">
                        <div>{{ Auth::user()->name }}</div>
                        <div class="font-medium truncate">{{ Auth::user()->email }}</div>
                        </div>
                        <ul class="py-2" aria-labelledby="avatarButton">
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">Dashboard</a>
                        </li>
                        </ul>
                        <div class="py-2 px-4">
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
                @else
                    <a href="{{ route('login') }}" class="bg-unnes-blue text-white px-4 py-2 rounded-full hover:bg-[#c3d1e6] hover:text-black text-md">
                        Login
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="border-2 border-unnes-blue bg-white text-unnes-blue px-4 py-2 rounded-full hover:bg-unnes-blue hover:text-white text-md">
                            Register
                        </a>
                    @endif
                @endauth
                <ion-icon onclick="onToggleMenu(this)" name="menu-outline" class="text-2xl cursor-pointer md:hidden"></ion-icon>
            </nav>
        @endif
    </div>
</header>

{{-- DropDown --}}
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>