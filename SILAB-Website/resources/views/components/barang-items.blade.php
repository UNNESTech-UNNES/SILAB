<!-- Toast Notification -->
<div id="toast" class="fixed top-4 right-4 z-50 hidden">
    <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center gap-2">
        <i class="fas fa-check-circle"></i>
        <span>Barang ditambahkan ke keranjang</span>
    </div>
</div>

@foreach($barangs as $barang)
<<<<<<< HEAD
        <!-- Card Item -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:-translate-y-1 transition">
            <div class="p-3">
                <img class="w-full h-48 object-cover rounded-lg" src="{{ asset('storage/' . $barang->gambar) }}" alt="Gambar Barang" />
                <div class="mt-3 space-y-2">
                    <div class="flex justify-between items-center">
                        <div class="px-2 py-0.5 bg-unnes-yellow rounded-lg">
                            <div class="flex items-center gap-1">
                                <span class="text-[#1a1a1a] text-xs font-semibold">Tersedia: {{ $barang->available_quantity }}/{{ $barang->total }}</span>
                            </div>
=======
    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:-translate-y-1 transition">
        <div class="p-3">
            <img class="w-full h-48 object-cover rounded-lg" src="{{ asset('storage/' . $barang->gambar) }}" alt="Gambar Barang" />
            <div class="mt-3 space-y-2">
                <div class="flex justify-between items-center">
                    <div class="px-2 py-0.5 bg-unnes-yellow rounded-lg">
                        <div class="flex items-center gap-1">
                            <span class="text-[#1a1a1a] text-xs font-semibold">
                                Tersedia: <span class="available-count">{{ $barang->available_quantity }}</span>/{{ $barang->total }}
                            </span>
>>>>>>> bd00f2ac0e382a202d6aa252a75addfdab9a0879
                        </div>
                    </div>
<<<<<<< HEAD
                    <div class="space-y-1">
                        <h3 class="text-black text-sm font-semibold">{{ $barang->nama_barang }}</h3>
                    </div>
                    <form action="{{ route('peminjam.keranjang.tambah') }}" method="POST">
                        @csrf
                        <input type="hidden" name="nama_barang" value="{{ $barang->nama_barang }}">
                        <input type="hidden" name="letak_barang" value="{{ $barang->letak_barang }}">
                        <button type="submit" class="w-full py-1.5 px-3 bg-unnes-blue hover:bg-[#c3d1e6] hover:text-black text-white text-xs rounded-full transition-colors duration-200 font-semibold" {{ $barang->available_quantity <= 0 ? 'disabled' : '' }}>
                                Tambahkan ke Keranjang
                        </button>
                    </form>
=======
                    <div class="text-[#999999] text-xs">Ruang {{ $barang->letak_barang }}</div>
>>>>>>> bd00f2ac0e382a202d6aa252a75addfdab9a0879
                </div>
                <div class="space-y-1">
                    <h3 class="text-black text-sm font-semibold">{{ $barang->nama_barang }}</h3>
                </div>
                <form class="add-to-cart-form" data-max="{{ $barang->available_quantity }}">
                    @csrf
                    <input type="hidden" name="nama_barang" value="{{ $barang->nama_barang }}">
                    <input type="hidden" name="letak_barang" value="{{ $barang->letak_barang }}">
                    <div class="flex gap-2 mb-2">
                        <div class="flex items-center space-x-1">
                            <button type="button" class="decrease-qty w-8 h-8 text-gray-600 hover:bg-gray-100 rounded-lg bg-white-100 border">
                                <i class="fas fa-minus text-xs"></i>
                            </button>
                            <input type="number" name="jumlah" min="1" max="{{ $barang->available_quantity }}" value="0" 
                                class="w-10 px-2 py-1 text-sm text-center appearance-none border-white border" 
                                {{ $barang->available_quantity <= 0 ? 'disabled' : '' }}>
                            <button type="button" class="increase-qty w-8 h-8 text-gray-600 hover:bg-gray-100 rounded-lg bg-white-100 border">
                                <i class="fas fa-plus text-xs"></i>
                            </button>
                        </div>
                        <button type="submit" 
                            class="flex-1 tracking-wider py-1.5 px-3 bg-unnes-blue hover:bg-[#c3d1e6] hover:text-black text-white text-sm rounded-full transition-colors duration-200"
                            {{ $barang->available_quantity <= 0 ? 'disabled' : '' }}>
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

<script>
function showToast() {
    const toast = document.getElementById('toast');
    toast.classList.remove('hidden');
    toast.classList.add('animate-fade-in');
    
    setTimeout(() => {
        toast.classList.add('animate-fade-out');
        setTimeout(() => {
            toast.classList.add('hidden');
            toast.classList.remove('animate-fade-in', 'animate-fade-out');
        }, 300);
    }, 2000);
}

document.querySelectorAll('.add-to-cart-form').forEach(form => {
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(form);
        
        try {
            const response = await fetch('{{ route("peminjam.keranjang.tambah") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
                body: formData
            });

            const data = await response.json();
            
            if (data.success) {
                showToast();
                
                // Update jumlah di keranjang (opsional)
                const cartCount = document.getElementById('cart-count');
                if (cartCount) {
                    cartCount.textContent = data.cartCount;
                }
            }
        } catch (error) {
            console.error('Error:', error);
        }
    });
});

document.querySelectorAll('.decrease-qty, .increase-qty').forEach(button => {
    button.addEventListener('click', function() {
        const container = this.closest('.bg-white'); // parent container
        const input = container.querySelector('input[name="jumlah"]');
        const availableDisplay = container.querySelector('.available-count');
        const totalAvailable = parseInt(input.getAttribute('max'));
        
        let newValue;
        if (this.classList.contains('decrease-qty')) {
            newValue = Math.max(0, parseInt(input.value) - 1);
        } else {
            newValue = Math.min(totalAvailable, parseInt(input.value) + 1);
        }
        
        input.value = newValue;
        availableDisplay.textContent = totalAvailable - newValue;
    });
});

// Update saat input manual
document.querySelectorAll('input[name="jumlah"]').forEach(input => {
    input.addEventListener('input', function() {
        const container = this.closest('.bg-white');
        const availableDisplay = container.querySelector('.available-count');
        const totalAvailable = parseInt(this.getAttribute('max'));
        const currentValue = Math.min(Math.max(0, parseInt(this.value) || 0), totalAvailable);
        
        this.value = currentValue;
        availableDisplay.textContent = totalAvailable - currentValue;
    });
});
</script>

<style>
    /* Menghilangkan tombol spinner pada input number */
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    
    input[type="number"] {
        -moz-appearance: textfield; /* Firefox */
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-100%); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes fadeOut {
        from { opacity: 1; transform: translateY(0); }
        to { opacity: 0; transform: translateY(-100%); }
    }
    
    .animate-fade-in {
        animation: fadeIn 0.3s ease-in-out forwards;
    }
    
    .animate-fade-out {
        animation: fadeOut 0.3s ease-in-out forwards;
    }
</style>