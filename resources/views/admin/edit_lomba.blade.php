<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Mata Lomba: {{ $lomba->nama_lomba }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('admin.lomba.update', $lomba->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Mata Lomba</label>
                        <input type="text" name="nama_lomba" value="{{ $lomba->nama_lomba }}" class="border-gray-300 rounded-md w-full focus:border-blue-500 focus:ring-blue-500" required>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat</label>
                        <textarea name="deskripsi" class="border-gray-300 rounded-md w-full focus:border-blue-500 focus:ring-blue-500" rows="4">{{ $lomba->deskripsi }}</textarea>
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.lomba') }}" class="text-gray-600 hover:text-gray-900 font-medium">Batal & Kembali</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
