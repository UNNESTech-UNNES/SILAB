<x-app-layout>
    <div class="container flex mx-auto px-4 md:px-16 lg:px-32 py-8 mt-8 md:mt-16">
        <div id="default-carousel" class="relative w-full" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative sm:rounded-lg md:rounded-xl lg:rounded-3xl overflow-hidden h-64 sm:h-72 md:h-80 lg:h-96 xl:h-96">
                <!-- Item 1 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="assets/slide 1.png" class="absolute block -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="assets/slide 2.png" class="absolute block -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 3 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="assets/slide 3.png" class="absolute block -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

    <section class="container px-4 md:px-16 lg:px-32 mx-auto">
        <div class="container mx-auto flex items-center flex-wrap">
            <x-list-barang :barangs="$barangs"/>
        </div>
    </section>
    <script>
        const navLinks = document.querySelector('.nav-links');
        function onToggleMenu(e) {
            e.name = e.name === 'menu' ? 'close' : 'menu';
            navLinks.classList.toggle('top-[9%]');
        }
    </script>
    <x-footer-user/>
</x-app-layout>