
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Akun Siswa: {{ $siswa->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('admin.siswa.update', $siswa->id) }}" method="POST">
                    @csrf
                    @method('PUT') 
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ $siswa->name }}" class="border-gray-300 rounded-md w-full focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Alamat Email</label>
                        <input type="email" name="email" value="{{ $siswa->email }}" class="border-gray-300 rounded-md w-full focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-md">
                        <label class="block text-gray-700 font-bold mb-2">Ubah Password (Opsional)</label>
                        <p class="text-sm text-gray-500 mb-2">*Biarkan kosong jika tidak ingin mengubah password siswa.</p>
                        <input type="password" name="password" placeholder="Ketik password baru di sini" class="border-gray-300 rounded-md w-full focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-gray-900 font-medium">Batal & Kembali</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>