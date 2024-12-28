<x-app-layout>
    <section class="container px-4 md:px-8 lg:px-32 mx-auto pt-16 md:pt-24">
        <div class="container mx-auto flex items-center flex-wrap">
            <x-list-barang :barangs="$barangs"/>
        </div>
    </section>

    <script>
        document.getElementById('searchButton').addEventListener('click', function() {
            const query = document.getElementById('searchInput').value;
            if (query) {
                window.location.href = `/search?query=${encodeURIComponent(query)}`;
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
    <script>
        // Filter handling
        function updateTable() {
            const search = document.getElementById('search').value;
            const filterLetak = document.getElementById('filterLetak').value;
            const status = document.getElementById('status').value;

            const params = new URLSearchParams({
                search: search,
                filterLetak: filterLetak,
                status: status
            });

            fetch(`/pemilik/dashboard?${params.toString()}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                document.getElementById('barangTable').innerHTML = html;
            })
            .catch(error => console.error('Error:', error));
        }

        // Event listeners
        document.getElementById('search').addEventListener('input', debounce(updateTable, 300));
        document.getElementById('filterLetak').addEventListener('change', updateTable);
        document.getElementById('status').addEventListener('change', updateTable);

        // Debounce function
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }
    </script>
</x-app-layout>