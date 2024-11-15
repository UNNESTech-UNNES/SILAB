<x-main-layout>

    <div class="container">
        <h1>Manajemen Akses Pengguna</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Aksi</th>
                    <th>Izin</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->is_active ? 'Aktif' : 'Nonaktif' }}</td>
                    <td>
                        <form action="{{ route('admin.toggle.active', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit">{{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('admin.update.permissions', $user->id) }}" method="POST">
                            @csrf
                            <label>
                                <input type="checkbox" name="permissions[can_borrow]" value="1" {{ isset($user->permissions['can_borrow']) ? 'checked' : '' }}> Pinjam
                            </label>
                            <label>
                                <input type="checkbox" name="permissions[can_manage]" value="1" {{ isset($user->permissions['can_manage']) ? 'checked' : '' }}> Kelola
                            </label>
                            <button type="submit">Perbarui Izin</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <h1>Daftar Pengguna</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Peran</th>
                    <th>Perizinan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->permissions }}</td>
                    <td>
                        <a href="{{ route('admin.dashboard', $user->id) }}" class="btn btn-primary">Kelola</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-main-layout>