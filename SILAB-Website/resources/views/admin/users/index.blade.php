<x-main-layout>
    <div class="px-6">
        <h1 class="text-2xl text-center font-bold pb-4 text-unnes-blue">Manajemen User</h1>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <div class="container mx-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                    <thead class="text-white">
                        <tr class="bg-unnes-blue">
                            <th class="px-6 py-3 text-left text-sm font-medium ">Nama</th>
                            <th class="px-6 py-3 text-left text-sm font-medium ">Email</th>
                            <th class="px-6 py-3 text-left text-sm font-medium ">Role</th>
                            <th class="px-6 py-3 text-left text-sm font-medium ">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($users as $user)
                            <tr class="text-sm hover:bg-slate-100">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $user->getRoleNames()->first() }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="bg-unnes-blue text-white rounded h-8 w-8 flex items-center justify-center"><i class="fa-solid fa-pen-to-square"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-ma-layout>