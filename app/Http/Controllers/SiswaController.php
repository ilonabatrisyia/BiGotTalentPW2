<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lomba;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function index()
    {
        // Ambil semua data lomba untuk form pendaftaran
        $lombas = Lomba::all();
        
        // Ambil riwayat pendaftaran khusus untuk siswa yang sedang login, urutkan dari yang terbaru
        $riwayat = Pendaftaran::with('lomba')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
        
        return view('siswa.dashboard', compact('lombas', 'riwayat'));
    }

    public function daftarLomba(Request $request)
    {
        $request->validate([
            'lomba_id' => 'required'
        ]);

        // Validasi: Cegah siswa mendaftar lomba yang sama lebih dari satu kali
        $sudahDaftar = Pendaftaran::where('user_id', Auth::id())
                                  ->where('lomba_id', $request->lomba_id)
                                  ->exists();

        if ($sudahDaftar) {
            return back()->with('error', 'Gagal: Anda sudah terdaftar di mata lomba ini.');
        }

        // Proses simpan pendaftaran dengan status awal
        Pendaftaran::create([
            'user_id' => Auth::id(),
            'lomba_id' => $request->lomba_id,
            'status' => 'Dokumen dalam Tinjauan' // Status default sesuai soal
        ]);
        
        return back()->with('success', 'Berhasil mendaftar! Silakan pantau status Anda di bawah.');
    }
}
