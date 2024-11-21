<aside class="w-64 bg-white text-white h-full fixed left-0 top-0 overflow-y-auto">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="flex items-center p-4 border-b border-gray-200">
        <img class="h-12 w-auto" src="{{ asset('assets/Logo Silab.svg') }}" alt="Logo Silab">
    </a>

    <!-- User Panel -->
    <div class="p-4 flex items-center border-b border-gray-200">
        <div class="w-10 h-10 rounded-full bg-unnes-blue text-white flex items-center justify-center mr-3">
            {{ substr(auth()->user()->name, 0, 1) }}
        </div>
        <div>
            <a href="#" class="text-gray-500 font-semibold">{{ auth()->user()->name }}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="p-4 text-gray-700 text-sm">
        <ul class="space-y-2">
            @foreach ($menus as $menu)
                @if (isset($menu["children"]))
                    @php
                        $isActive = request()->routeIs($menu['route']) || collect($menu['children'])->pluck('route')->contains(function ($route) {
                            return request()->routeIs($route);
                        });
                    @endphp
                    <li x-data="{ open: {{ $isActive ? 'true' : 'false' }} }">
                        <div @click="open = !open" class="cursor-pointer flex items-center justify-between p-2 rounded {{ $isActive ? 'bg-[#E6E6F2] text-unnes-blue' : 'hover:bg-[#E6E6F2] hover:text-unnes-blue' }}">
                            <div class="flex items-center">
                                <i class="{{ $menu['icon'] }} mr-3"></i>
                                <span class="{{ $isActive ? 'text-unnes-blue' : '' }}">{{ $menu["name"] }}</span>
                            </div>
                            <span class="bg-blue-500 text-white text-xs rounded-full px-2 py-1">
                                {{ count($menu["children"]) }}
                            </span>
                        </div>
                        
                        <ul x-show="open" class="pl-6 mt-2 space-y-2">
                            @foreach ($menu["children"] as $child)
                                <li>
                                    <a href="{{ route($child['route']) }}" class="block p-2 rounded {{ request()->routeIs($child['route']) ? 'bg-[#E6E6F2] text-unnes-blue' : 'hover:bg-[#E6E6F2] hover:text-unnes-blue' }}">
                                        <i class="{{ $child['icon'] }} mr-3"></i>
                                        {{ $child["name"] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @else
                    <li>
                        <a href="{{ route($menu['route']) }}" class="flex items-center p-2 rounded {{ request()->routeIs($menu['route']) ? 'bg-[#E6E6F2] text-unnes-blue' : 'hover:bg-[#E6E6F2] hover:text-unnes-blue' }}">
                            <i class="{{ $menu['icon'] }} mr-3"></i>
                            <span class="{{ request()->routeIs($menu['route']) ? 'text-unnes-blue' : '' }}">{{ $menu["name"] }}</span>
                        </a>
                    </li>
                @endif
            @endforeach

            <!-- Logout Button -->
            <li>
                <a href="{{ route('logout') }}" 
                class="flex items-center p-2 hover:bg-red-700 rounded text-red-400 hover:text-white"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    <span>{{ __('Logout') }}</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
</aside>

<!-- Add Alpine.js for dropdown functionality -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>