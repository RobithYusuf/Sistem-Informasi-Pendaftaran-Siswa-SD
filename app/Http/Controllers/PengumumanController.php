<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use App\Models\Pendaftaran;
use Illuminate\View\View;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengumumanController extends Controller
{
    //halaman admin index
    public function index()
    {
        $pengumuman = Pengumuman::all();
        return view('admin.pengumuman.pengumuman', compact('pengumuman'));
    }


    public function create()
    {
        return view('admin.pengumuman.tambah');
    }

    //hapus
    public function hapus($id)
    {
        $pengumuman = Pengumuman::find($id);
        $pengumuman->delete();

        return response()->json(['success' => 'Pengumuman berhasil dihapus']);
    }


    //admin lihat data
    public function detailadmin($id)
    {
        $pengumuman = Pengumuman::find($id);
        if (!$pengumuman) {
            return response()->json(['error' => 'Pengumuman tidak ditemukan'], 404);
        }
        return response()->json($pengumuman);
    }
    // public function detail($id)
    // {
    //     $pengumuman = Pengumuman::with('pendaftaran')->find($id);
    //     if (!$pengumuman) {
    //         return response()->json(['error' => 'Data tidak ditemukan'], 404);
    //     }
    //     return response()->json($pengumuman);
    // }

    public function destroy($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->delete();

        return redirect()->route('pengumuman.index.admin')->with('success', 'Pengumuman berhasil dihapus.');
    }


    public function detail($id)
    {
        // Mencari informasi berdasarkan ID
        $pendaftaran = Pendaftaran::where('status_pendaftaran', 'Diterima')->get();
        $informasiDaftarUlang = Informasi::find(3); // Mengakses data Daftar Ulang dengan ID 3
        $informasiSiswaMasuk = Informasi::find(4); // Mengakses data Siswa Masuk dengan ID 4
        $pengumuman = Pengumuman::find($id);
        if (!$pengumuman) {
            return redirect()->route('pengumuman.index')->with('error', 'ID Jadwal tidak ditemukan');
        }
        return view('frontend.pengumuman.detail-pengumuman', compact('pengumuman', 'pendaftaran', 'informasiDaftarUlang', 'informasiSiswaMasuk'));
    }

    public function edit(Pengumuman $pengumuman)
    {
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        // Anda bisa menambahkan validasi sama seperti di method `store`
        $pengumuman->update($request->all());
        return redirect()->route('pengumuman.index.admin')->with('success', 'Data Pengumuman berhasil diperbarui.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_pengumuman' => 'required|string|max:255',
            'tanggal_pengumuman' => 'required|date',
            'keterangan' => 'required|string',
        ]);

        $pengumuman = new Pengumuman();
        $pengumuman->judul_pengumuman = $request->judul_pengumuman;
        $pengumuman->tanggal_pengumuman = $request->tanggal_pengumuman;
        $pengumuman->keterangan = $request->keterangan;
        $pengumuman->save();

        return redirect()->route('pengumuman.index.admin')->with('success', 'Pengumuman berhasil ditambahkan.');
    }


    //halaman guest
    public function pengumuman()
    {
        $pengumuman = Pengumuman::all();
        return view('frontend.pengumuman.pengumuman', compact('pengumuman'));
    }

    public function getPengumumanTanggal()
    {
        $pengumuman = Pengumuman::first(); // asumsi hanya ada satu pengumuman
        return response()->json(['tanggal_pengumuman' => $pengumuman->tanggal_pengumuman]);
    }
}
