<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lomba;          
use App\Models\Pendaftaran;     
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // --- BAGIAN TAMPILAN HALAMAN (MENUS) ---

    // 1. Halaman Welcome Admin (Kosong/Ringkasan)
    public function index() 
    {
        return view('admin.dashboard'); 
    }

    // 2. Halaman Khusus Lomba
    public function kelolaLomba() 
    {
        $lombas = Lomba::all();
        return view('admin.kelola_lomba', compact('lombas'));
    }

    // 3. Halaman Khusus Siswa
    public function kelolaSiswa() 
    {
        // Ambil semua data user yang berstatus 'siswa'
        $siswas = User::where('role', 'siswa')->get();
        return view('admin.kelola_siswa', compact('siswas'));
    }

    // 4. Halaman Khusus Status
    public function kelolaStatus() 
    {
        $pendaftarans = Pendaftaran::with(['user', 'lomba'])->get();
        return view('admin.kelola_status', compact('pendaftarans'));
    }


    // --- BAGIAN PROSES DATA (CRUD LOMBA & STATUS) ---

    // Menyimpan Data Mata Lomba Baru (Create)
    public function storeLomba(Request $request)
    {
        // Simpan semua inputan dari form web ke tabel lomba
        Lomba::create($request->all());
        
        // Kembalikan admin ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Mata Lomba berhasil ditambahkan!');
    }

    // Tampilkan Halaman EDIT Lomba
    public function editLomba($id)
    {
        $lomba = Lomba::findOrFail($id);
        return view('admin.edit_lomba', compact('lomba'));
    }

    // UPDATE (Simpan Perubahan Lomba)
    public function updateLomba(Request $request, $id)
    {
        $lomba = Lomba::findOrFail($id);
        $lomba->update($request->all());
        
        return redirect()->route('admin.lomba')->with('success', 'Mata lomba berhasil diperbarui!');
    }

    // DELETE (Hapus Lomba)
    public function destroyLomba($id)
    {
        Lomba::findOrFail($id)->delete();
        return back()->with('success', 'Mata lomba berhasil dihapus!');
    }

    // Mengubah Status Pendaftaran Siswa (Update)
    public function updateStatus(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update(['status' => $request->status]);
        
        return back()->with('success', 'Status pendaftaran berhasil diubah!');
    }


    // --- BAGIAN PROSES DATA (CRUD AKUN SISWA) ---

    // CREATE (Tambah Siswa)
    public function storeSiswa(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Enkripsi password
            'role' => 'siswa'
        ]);
        return back()->with('success', 'Akun siswa berhasil dibuat!');
    }

    // Tampilkan Halaman EDIT Siswa
    public function editSiswa($id)
    {
        $siswa = User::findOrFail($id);
        return view('admin.edit_siswa', compact('siswa'));
    }

    // UPDATE (Simpan Perubahan Siswa)
    public function updateSiswa(Request $request, $id)
    {
        $siswa = User::findOrFail($id);
        $siswa->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Update password hanya jika kolom password diisi
        if($request->filled('password')) {
            $siswa->update(['password' => Hash::make($request->password)]);
        }

        // Redirect kembali ke halaman menu Kelola Siswa
        return redirect()->route('admin.siswa')->with('success', 'Data siswa berhasil diperbarui!');
    }

    // DELETE (Hapus Siswa)
    public function destroySiswa($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'Akun siswa berhasil dihapus!');
    }
}