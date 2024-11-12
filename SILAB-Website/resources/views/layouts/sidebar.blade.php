<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <i class="fas fa-tshirt brand-image img-circle" style="font-size: 25px; margin-top: 5px;"></i>
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <div class="img-circle elevation-2" style="background-color: #ff7207; width: 35px; height: 35px; text-align: center; line-height: 35px; font-size: 18px; color: #fff;">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    {{ auth()->user()->name }}
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @foreach ($menus as $menu)
                @if (isset($menu["children"]))
                @php
                    $isActive = request()->routeIs($menu['route']) || collect($menu['children'])->pluck('route')->contains(function ($route) {
                        return request()->routeIs($route);
                    });
                @endphp
                <li class="nav-item has-treeview {{ $isActive ? 'menu-open' : '' }}">
                    <a href="{{ route($menu['route']) }}" class="nav-link {{ $isActive ? 'active' : '' }}">
                        <i class="nav-icon {{ $menu['icon'] }}"></i>
                        <p>
                            {{ $menu["name"] }}
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right">
                                {{ count($menu["children"]) }}
                            </span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @foreach ($menu["children"] as $child)
                        <li class="nav-item">
                            <a href="{{ route($child['route']) }}" class="nav-link {{ request()->routeIs($child['route']) ? 'active' : '' }}">
                                <i class="nav-icon {{ $child['icon'] }}"></i>
                                <p>{{ $child["name"] }}</p>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @else
                <li class="nav-item">
                    <a href="{{ route($menu['route']) }}" class="nav-link {{ request()->routeIs($menu['route']) ? 'active' : '' }}">
                        <i class="nav-icon {{ $menu['icon'] }}"></i>
                        <p>
                            {{ $menu["name"] }}
                        </p>
                    </a>
                </li>
                @endif
                @endforeach
                <!-- logout button -->
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            {{ __('Logout') }}
                        </p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>