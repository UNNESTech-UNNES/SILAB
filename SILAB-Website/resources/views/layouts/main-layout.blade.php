<!DOCTYPE html>
<html lang="en">
<head>
    @include('components.links')
</head>
<body class="font-['Poppins']"
    x-data="{ sidebarOpen: true }" 
    class="bg-white font-sans antialiased"
>
    <div class="min-h-screen flex shadow-lg">
        <!-- Sidebar -->
        <div 
            x-show="sidebarOpen"
            x-transition:enter="transition ease-out"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            class="w-64 bg-white shadow-md fixed z-40 inset-y-0 left-0 transform transition-all ease-in-out lg:relative lg:translate-x-0"
            :class="{'-translate-x-full': !sidebarOpen}"
        >
            <!-- Sidebar content -->
            <x-sidebar/>
        </div>

        <!-- Overlay for mobile -->
        <div 
            x-show="sidebarOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="sidebarOpen = false"
            class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden"
        ></div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col">
            <!-- Navbar -->
            <nav class="bg-unnes-blue shadow-lg">
                <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-16">
                        <button 
                            @click="sidebarOpen = !sidebarOpen"
                            class="text-white hover:bg-unnes-yellow focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 p-2 rounded"
                        >
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                    </div>
                </div>
            </nav>

            <!-- Content Wrapper -->
            <main class="flex-1 overflow-y-auto p-6 bg-white">
                <div class="container mx-auto">
                    {{ $slot }}
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white shadow-md p-4">
                <div class="container mx-auto flex justify-between items-center">
                    <div class="text-sm text-gray-600">
                        <strong>Copyright &copy; 2024 <a href="#" class="text-blue-600 hover:underline">SILAB Sistem Inventaris Laboratorium</a>.</strong> All rights reserved.
                    </div>
                    <div class="text-sm text-gray-500">
                        <b>Version</b> 3.2.0
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>