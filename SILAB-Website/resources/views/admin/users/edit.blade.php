<x-main-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Edit Role & Permission User</h1>
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Role Selection -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Role:</label>
                <select name="role" class="border rounded px-2 py-1 w-full" required>
                    <option value="">Pilih Role</option>
                    
                    <!-- Role Admin & Peminjam -->
                    <option value="admin" {{ $user->hasRole('admin') ? 'selected' : '' }}>Admin</option>
                    <option value="peminjam" {{ $user->hasRole('peminjam') ? 'selected' : '' }}>Peminjam</option>
                    
                    <!-- Role Pemilik -->
                    <optgroup label="Pemilik">
                        <option value="pemilik-medunes" {{ $user->hasRole('pemilik-medunes') ? 'selected' : '' }}>Pemilik MEDUNES</option>
                        <option value="pemilik-sparka" {{ $user->hasRole('pemilik-sparka') ? 'selected' : '' }}>Pemilik SPARKA</option>
                        <option value="pemilik-facetro" {{ $user->hasRole('pemilik-facetro') ? 'selected' : '' }}>Pemilik FACETRO</option>
                        <option value="pemilik-silab" {{ $user->hasRole('pemilik-silab') ? 'selected' : '' }}>Pemilik SILAB</option>
                        <option value="pemilik-lms" {{ $user->hasRole('pemilik-lms') ? 'selected' : '' }}>Pemilik LMS</option>
                        <option value="pemilik-remosto" {{ $user->hasRole('pemilik-remosto') ? 'selected' : '' }}>Pemilik REMOSTO</option>
                    </optgroup>
                </select>
            </div>

            {{-- <!-- Permissions -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Permissions:</label>
                <div class="grid grid-cols-2 gap-4">
                    @foreach($permissions as $permission)
                        <div class="flex items-center">
                            <input type="checkbox" 
                                name="permissions[]" 
                                value="{{ $permission->name }}"
                                {{ $user->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                class="mr-2">
                            <label>{{ ucfirst($permission->name) }}</label>
                        </div>
                    @endforeach
                </div>
            </div> --}}

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Simpan Perubahan
            </button>
        </form>
    </div>
</x-main-layout>