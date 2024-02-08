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

    public function store(Request $request)
    {
        $request->validate([
            'kegiatan' => 'required',
            'jenis' => 'required',
            'deskripsi' => 'nullable',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date',
        ]);

        $informasi = new Informasi;
        $informasi->kegiatan = $request->input('kegiatan');
        $informasi->jenis = $request->input('jenis');
        $informasi->deskripsi = $request->input('deskripsi');
        $informasi->tanggal_mulai = $request->input('tanggal_mulai');
        $informasi->tanggal_selesai = $request->input('tanggal_selesai');
        $informasi->save();

        return redirect()->route('informasi.index.admin')->with('success', 'Informasi kegiatan berhasil disimpan');
    }

    public function edit($id)
    {
        // Mencari informasi berdasarkan ID
        $data = Informasi::findorfail($id);

        return view('admin.informasi-jadwal.edit', compact('data'));
    }



    public function update(Request $request, $id)
    {
        $informasi = Informasi::findOrFail($id);
       
        $validatedData = $request->validate([
            'kegiatan' => 'required|string|max:55',
            'deskripsi' => 'nullable',
            'jenis' => 'required',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
        ]);

        $informasi->fill($validatedData);
        $informasi->save();

        return redirect()->route('informasi.index.admin')->with('success', 'Informasi berhasil diperbarui');
    }

    public function create()
    {
        return view('admin.informasi-jadwal.tambah');
    }

    public function hapus($id)
    {
        $pengumuman = Informasi::find($id);
        $pengumuman->delete();

        return response()->json(['success' => 'Pengumuman berhasil dihapus']);
    }
}
