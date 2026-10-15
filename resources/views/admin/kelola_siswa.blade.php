<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kelola Akun Siswa
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Menampilkan Pesan Sukses -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- KOTAK Utama: Kelola Akun Siswa (CRUD User) -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-bold mb-4 text-gray-800">Manajemen Akun Siswa</h3>
                
                <!-- Form Tambah Siswa Singkat -->
                <form action="{{ route('admin.siswa.store') }}" method="POST" class="mb-6 bg-gray-50 p-4 rounded-md border border-gray-200">
                    @csrf
                    <h4 class="font-semibold text-sm mb-3 text-blue-600">Buat Akun Siswa Baru</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <input type="text" name="name" placeholder="Nama Lengkap Siswa" class="border-gray-300 rounded-md w-full focus:border-blue-500 focus:ring-blue-500" required>
                        <input type="email" name="email" placeholder="Email (Contoh: siswa@sekolah.com)" class="border-gray-300 rounded-md w-full focus:border-blue-500 focus:ring-blue-500" required>
                        <input type="password" name="password" placeholder="Password (Minimal 8 Karakter)" class="border-gray-300 rounded-md w-full focus:border-blue-500 focus:ring-blue-500" minlength="8" required>
                    </div>
                    <button type="submit" class="mt-3 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm transition duration-150">
                        + Tambah Siswa
                    </button>
                </form>

                <!-- Tabel Data Siswa -->
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="border border-gray-300 p-3">Nama Siswa</th>
                                <th class="border border-gray-300 p-3">Email</th>
                                <th class="border border-gray-300 p-3 text-center w-48">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($siswas as $siswa)
                            <tr class="hover:bg-gray-50">
                                <td class="border border-gray-300 p-3">{{ $siswa->name }}</td>
                                <td class="border border-gray-300 p-3">{{ $siswa->email }}</td>
                                <td class="border border-gray-300 p-3 text-center">
                                    <div class="flex justify-center gap-2">
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('admin.siswa.edit', $siswa->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm transition duration-150">
                                            Edit
                                        </a>
                                        
                                        <!-- Tombol Hapus (Menggunakan Form karena method DELETE) -->
                                        <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun {{ $siswa->name }}? Seluruh riwayat pendaftarannya juga akan ikut terhapus!');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm transition duration-150">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            
                            @if($siswas->isEmpty())
                            <tr>
                                <td colspan="3" class="border border-gray-300 p-6 text-center text-gray-500 italic">
                                    Belum ada data siswa yang terdaftar.
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
