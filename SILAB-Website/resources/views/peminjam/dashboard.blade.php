<nav class="bg-biru-0 fixed top-0 w-full shadow-xl">
    <div class="mx-auto max-w-7xl px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-3">
            @php
            $user = Auth::user();
            $initials = strtoupper(substr($user->name, 0, 1));
            $colors = ['bg-red-500', 'bg-green-500', 'bg-blue-500', 'bg-yellow-500', 'bg-purple-500'];
            $randomColor = $colors[array_rand($colors)];
            @endphp
            <div class="text-white w-12 h-12 rounded-full font-medium text-base flex items-center justify-center {{ $randomColor }}">
                {{ $initials }}
            </div>
            <div class="text-white thic">
                <h1 class="text-sm">Selamat Datang,</h1>
                <h1 class="font-bold text-lg"> {{ Auth::user()->name }}</h1>
            </div>
        </div>
        <div class="nav-item bg-white text-biru-0 py-2 px-4 rounded-3xl flex items-center justify-center text-sm">
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

    <form action="{{ route('peminjam.kepemilikan.ajukan') }}" method="POST">
        @csrf
        <label for="tipe_kepemilikan">Pilih Tipe Kepemilikan:</label>
        <select name="tipe_kepemilikan" id="tipe_kepemilikan" class="border rounded p-2">
            @foreach ($tipeKepemilikan as $type)
                <option value="{{ $type->id }}">{{ $type->nama }}</option>
            @endforeach
        </select>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Ajukan</button>
    </form>

    @if(Auth::user()->bisa_jadi_pemilik && Auth::user()->role === 'peminjam')
    <a href="{{ route('ganti.ke.pemilik') }}" class="btn btn-primary">Ganti ke Pemilik</a>
    @endif

</nav>