<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manajemen Status Peserta</h2>
    </x-slot>
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">{{ session('success') }}</div>
        @endif
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="border border-gray-300 p-3">Nama Siswa</th>
                        <th class="border border-gray-300 p-3">Mata Lomba</th>
                        <th class="border border-gray-300 p-3">Status Saat Ini</th>
                        <th class="border border-gray-300 p-3">Aksi Update</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendaftarans as $daftar)
                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-300 p-3">{{ $daftar->user->name }}</td>
                        <td class="border border-gray-300 p-3 font-semibold">{{ $daftar->lomba->nama_lomba }}</td>
                        <td class="border border-gray-300 p-3"><span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-sm font-bold">{{ $daftar->status }}</span></td>
                        <td class="border border-gray-300 p-3">
                            <form action="{{ route('admin.status.update', $daftar->id) }}" method="POST" class="flex gap-2">
                                @csrf
                                <select name="status" class="border-gray-300 rounded-md text-sm">
                                    <option value="Dokumen dalam Tinjauan">Dokumen dalam Tinjauan</option>
                                    <option value="Jadwal Briefing">Jadwal Briefing</option>
                                    <option value="Tahap Pelatihan">Tahap Pelatihan</option>
                                    <option value="Final">Final</option>
                                </select>
                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">Update</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div></div>
</x-app-layout>
