<x-main-layout>
    <div class="px-6">
        <h1 class="text-2xl text-center font-bold pb-4 text-unnes-blue">Manajemen User</h1>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <div class="container mx-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="text-white">
                            <tr class="bg-unnes-blue">
                                <th class="px-6 py-3 text-left text-sm font-medium">Nama</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Email</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Role</th>
                                <th class="px-6 py-3 text-left text-sm font-medium">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($users as $user)
                                <tr class="text-sm hover:bg-slate-100">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->getRoleNames()->first() }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <button onclick="openEditModal({{ $user->id }})" 
                                            class="bg-unnes-blue text-white rounded h-8 w-8 flex items-center justify-center">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="modalEdit" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-[600px] shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Edit User</h3>
                <form id="formEditUser">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_user_id" name="id">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                        <input type="text" id="edit_name" name="name" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-unnes-blue">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" id="edit_email" name="email" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-unnes-blue">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                        <select id="edit_role" name="role" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-unnes-blue">
                            <option value="admin">Admin</option>
                            <option value="peminjam">Peminjam</option>
                            <option value="pemilik-medunes">Pemilik Medunes</option>
                            <option value="pemilik-sparka">Pemilik Sparka</option>
                            <option value="pemilik-facetro">Pemilik Facetro</option>
                            <option value="pemilik-silab">Pemilik Silab</option>
                            <option value="pemilik-lms">Pemilik LMS</option>
                            <option value="pemilik-remosto">Pemilik Remosto</option>
                        </select>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeEditModal()"
                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-unnes-blue text-white rounded-md hover:bg-unnes-blue/80">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openEditModal(userId) {
            fetch(`/admin/users/${userId}/edit`, {
                headers: {
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('edit_user_id').value = userId;
                    document.getElementById('edit_name').value = data.user.name;
                    document.getElementById('edit_email').value = data.user.email;
                    document.getElementById('edit_role').value = data.user.roles[0].name;
                    document.getElementById('modalEdit').classList.remove('hidden');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memuat data user');
            });
        }

        function closeEditModal() {
            document.getElementById('modalEdit').classList.add('hidden');
            document.getElementById('formEditUser').reset();
        }

        document.addEventListener('DOMContentLoaded', function() {
            const formEdit = document.getElementById('formEditUser');
            if (formEdit) {
                formEdit.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    const userId = document.getElementById('edit_user_id').value;
                    const formData = new FormData(this);

                    try {
                        const response = await fetch(`/admin/users/${userId}`, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'X-HTTP-Method-Override': 'PUT',
                                'Accept': 'application/json'
                            }
                        });

                        const data = await response.json();
                        
                        if (data.success) {
                            closeEditModal();
                            window.location.reload();
                            alert('User berhasil diperbarui');
                        } else {
                            alert(data.message || 'Gagal memperbarui user');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat memperbarui user');
                    }
                });
            }
        });
    </script>
</x-main-layout>