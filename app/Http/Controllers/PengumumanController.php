<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use App\Models\Pendaftaran;
use Illuminate\View\View;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

    public function edit(Pengumuman $pengumuman)
    {
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $validatedData = $request->validate([
            'judul_pengumuman' => 'required|string|max:255', // Judul pengumuman harus diisi, bertipe string, dan panjang maksimum 255 karakter
            'tanggal_pengumuman' => 'required|date', // Tanggal pengumuman harus diisi dan harus dalam format tanggal yang valid
            'keterangan' => 'required|string' // Keterangan harus diisi dan bertipe string
        ]);

        // Proses update pengumuman dengan data yang telah divalidasi
        $pengumuman->update($validatedData);

        // Redirect kembali ke halaman edit dengan pesan sukses
        return redirect()->route('pengumuman.edit', $pengumuman->id)->with('success', 'Data Pengumuman berhasil diperbarui.');
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



    public function detail($id)
    {
        // Mencari informasi berdasarkan ID
        $pendaftaran = Pendaftaran::where('status_pendaftaran', 'Diterima')->get();
        $pengumuman = Pengumuman::find($id);
        if (!$pengumuman) {
            return redirect()->route('pengumuman.index')->with('error', 'ID Jadwal tidak ditemukan');
        }
        $informasiDaftarUlang = Informasi::where('jenis', 'daftarulang')->first();
        $informasiSiswaMasuk = Informasi::where('jenis', 'siswamasuk')->first();
        $pengumumanContent = str_replace(
            ['{informasi_daftar_ulang}', '{tanggal_daftar_ulang}', '{informasi_siswa_masuk}', '{tanggal_siswa_masuk}'],
            [$informasiDaftarUlang->deskripsi, $informasiDaftarUlang->tanggal_mulai, $informasiSiswaMasuk->deskripsi, $informasiSiswaMasuk->tanggal_mulai],
            $pengumuman->keterangan
        );


        // Cek apakah tanggal saat ini sudah melewati tanggal pengumuman
        $now = Carbon::now();
        if ($now->lt(new Carbon($pengumuman->tanggal_pengumuman))) {
            // Jika belum, kembali ke halaman sebelumnya atau halaman error
            return redirect()->route('pengumuman.index')->with('error', 'Pengumuman belum tersedia.');
        }

        // Lanjutkan untuk menampilkan detail pengumuman
        return view('frontend.pengumuman.detail-pengumuman', compact('pengumuman', 'pengumumanContent', 'pendaftaran'));
    }
}
