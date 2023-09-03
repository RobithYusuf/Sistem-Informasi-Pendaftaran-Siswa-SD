<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InformasiController extends Controller
{
    public function index()
    {
        $informasi = Informasi::all();
        return view('admin.informasi-jadwal.jadwal', compact('informasi'));
    }
    public function landingPageIndex()
    {
        $informasi = Informasi::take(5)->get();

        return view('frontend.index', compact('informasi'));
    }

    public function edit($id)
    {
        // Mencari informasi berdasarkan ID
        $data = Informasi::find($id);
        if (!$data) {
            return redirect()->route('informasi.index.admin')->with('error', 'ID Jadwal tidak ditemukan');
        }
        $jenis = $data->jenis;
        return view('admin.informasi-jadwal.edit', compact('data', 'jenis'));
    }


    public function update(Request $request, $id)
    {

        // Mencari informasi berdasarkan ID
        $informasi = Informasi::find($id);

        // Jika informasi tidak ditemukan, redirect ke halaman yang sesuai dengan pesan error
        if (!$informasi) {
            return redirect()->route('informasi.edit')->with('error', 'Informasi tidak ditemukan');
        }

        // Validasi input dari form
        $validatedData = $request->validate([
            'judul_informasi' => 'required|string|max:55',
            'detail' => 'required',
            'tanggal' => 'nullable|date',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date',
            'tanggal_pengumuman' => 'nullable|date',
            'tanggal_daftar_ulang' => 'nullable|date',
        ]);

        $informasi->update($validatedData);


        // Update kolom dalam database dengan data dari form
        $informasi->judul_informasi = $request->judul_informasi;
        $informasi->detail = $request->detail;
        $informasi->tanggal = $request->tanggal;
        $informasi->tanggal_mulai = $request->tanggal_mulai;
        $informasi->tanggal_selesai = $request->tanggal_selesai;
        $informasi->tanggal_pengumuman = $request->tanggal_pengumuman;
        $informasi->tanggal_daftar_ulang = $request->tanggal_daftar_ulang;
        $informasi->save();


        // Redirect ke halaman yang sesuai dengan pesan sukses
        return redirect()->route('informasi.index.admin')->with('success', 'Informasi berhasil diperbarui');
    }
}
