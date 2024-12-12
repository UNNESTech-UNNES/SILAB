<x-main-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Kirim Pesan ke Peminjam</h1>

        <form action="{{ route('admin.notifikasi.store-message') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block mb-2">Pilih Peminjam:</label>
                <select name="user_id" class="w-full border rounded p-2">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-2">Pesan:</label>
                <textarea name="message" rows="4" class="w-full border rounded p-2"></textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                Kirim Pesan
            </button>
        </form>
    </div>
</x-main-layout> 