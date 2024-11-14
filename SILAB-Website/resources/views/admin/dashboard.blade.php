<x-main-layout>
    @foreach ($permintaan as $request)
    <div class="mb-4 p-4 border rounded">
        <p>{{ $request->user->name }} mengajukan {{ $request->tipeKepemilikan->nama }}</p>
        <form action="{{ route('admin.kepemilikan.setujui', $request->id) }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Setujui</button>
        </form>
        <form action="{{ route('admin.kepemilikan.tolak', $request->id) }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Tolak</button>
        </form>
    </div>
    @endforeach
</x-main-layout>