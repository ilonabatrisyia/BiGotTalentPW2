<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kelola Mata Lomba
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Pesan Notifikasi Sukses -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- KOTAK 1: Form Tambah Lomba -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-bold mb-4 text-blue-600">Tambah Mata Lomba Baru</h3>
                <form action="{{ route('admin.lomba.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Mata Lomba</label>
                        <input type="text" name="nama_lomba" placeholder="Contoh: Web Design" class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm w-full" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat</label>
                        <textarea name="deskripsi" placeholder="Deskripsi lomba..." class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm w-full" rows="3"></textarea>
                    </div>

                    <!-- TOMBOL KIRIM (SUBMIT) -->
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md shadow-sm transition duration-150">
                        + Simpan Lomba
                    </button>
                </form>
            </div>

            <!-- KOTAK 2: Daftar Mata Lomba Tersedia -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-bold mb-4 text-gray-800">Daftar Mata Lomba Tersedia</h3>
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="border border-gray-300 p-3 w-1/4">Nama Lomba</th>
                                <th class="border border-gray-300 p-3 w-1/2">Deskripsi</th>
                                <th class="border border-gray-300 p-3 w-1/4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lombas as $lomba)
                            <tr class="hover:bg-gray-50">
                                <td class="border border-gray-300 p-3 font-semibold">{{ $lomba->nama_lomba }}</td>
                                <td class="border border-gray-300 p-3 text-gray-600">{{ $lomba->deskripsi }}</td>
                                <td class="border border-gray-300 p-3 text-center">
                                    <div class="flex justify-center gap-2">
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('admin.lomba.edit', $lomba->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm transition duration-150">Edit</a>
                                        
                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('admin.lomba.destroy', $lomba->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus mata lomba ini? Semua pendaftaran siswa pada lomba ini mungkin ikut terhapus!');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm transition duration-150">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                            @if($lombas->isEmpty())
                            <tr>
                                <td colspan="3" class="border border-gray-300 p-6 text-center text-gray-500 italic">
                                    Belum ada mata lomba yang ditambahkan.
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