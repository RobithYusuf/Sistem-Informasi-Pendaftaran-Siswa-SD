<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Berkas;
use App\Models\Informasi;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class BerkasController extends Controller
{
    public function index()
    {
        $berkas = Berkas::all();
        return view('admin.daftarulang.berkas', compact('berkas'));
    }
    public function edit($id)
    {
        // Mencari informasi berdasarkan ID
        $data = Berkas::find($id);
        if (!$data) {
            return redirect()->route('informasi.index.admin')->with('error', 'ID berkas tidak ditemukan');
        }
        return
            view('admin.informasi-jadwal.edit', compact('data'));
    }


    public function daftarulang()
    {
        return view('frontend.daftarulang.index');
    }


    // public function validasidata(Request $request)
    // {
    //     $nik = $request->input('nik');
    //     $tanggal_lahir = \DateTime::createFromFormat('dmY', $request->input('tanggal_lahir'));
    //     $formatted_tanggal_lahir = $tanggal_lahir->format('Y-m-d');
    //     $pendaftaran = Pendaftaran::where('nik', $nik)->where('tanggal_lahir', $formatted_tanggal_lahir)->first();

    //     if ($pendaftaran) {
    //         return response()->json([
    //             'success' => true,
    //             'pendaftaran_id' => $pendaftaran->id,
    //             'nik' => $pendaftaran->nik,
    //             'nama' => $pendaftaran->nama
    //         ]);
    //     } else {
    //         return response()->json(['success' => false, 'error' => 'Data tidak ditemukan']);
    //     }
    // }
    //     public function validasidata(Request $request)
    // {
    //     $nik = $request->input('nik');
    //     $tanggal_lahir = \DateTime::createFromFormat('dmY', $request->input('tanggal_lahir'));
    //     $formatted_tanggal_lahir = $tanggal_lahir->format('Y-m-d');

    //     $informasiDaftarUlang = Informasi::find(3); // Ambil baris dengan ID 3 untuk tanggal daftar ulang
    //     $informasiTanggalMasuk = Informasi::find(4); // Ambil baris dengan ID 4 untuk tanggal masuk

    //     $tanggal_daftar_ulang = $informasiDaftarUlang ? Carbon::parse($informasiDaftarUlang->tanggal_daftar_ulang) : null;
    //     $tanggal_masuk = $informasiTanggalMasuk ? Carbon::parse($informasiTanggalMasuk->tanggal) : null;

    //     // Cek apakah tanggal sekarang berada di antara tanggal daftar ulang dan tanggal masuk
    //     if (!$tanggal_daftar_ulang || !$tanggal_masuk || !Carbon::now()->between($tanggal_daftar_ulang->startOfDay(), $tanggal_masuk->endOfDay())) {
    //         return response()->json(['success' => false, 'error' => 'Tidak dalam periode daftar ulang']);
    //     }

    //         $pendaftaran = Pendaftaran::where('nik', $nik)->where('tanggal_lahir', $formatted_tanggal_lahir)->first();

    //         if ($pendaftaran) {
    //             return response()->json([
    //                 'success' => true,
    //                 'pendaftaran_id' => $pendaftaran->id,
    //                 'nik' => $pendaftaran->nik,
    //                 'nama' => $pendaftaran->nama
    //             ]);
    //         } else {
    //             return response()->json(['success' => false, 'error' => 'Data tidak ditemukan']);
    //         }
    //     }


    public function validasidata(Request $request)
    {
        $nik = $request->input('nik');
        $tanggal_lahir = \DateTime::createFromFormat('dmY', $request->input('tanggal_lahir'));
        $formatted_tanggal_lahir = $tanggal_lahir->format('Y-m-d');

        $pendaftaran = Pendaftaran::where('nik', $nik)->where('tanggal_lahir', $formatted_tanggal_lahir)->first();

        if (!$pendaftaran) {
            return response()->json(['success' => false, 'error' => 'Data tidak ditemukan']);
        }

        $informasiDaftarUlang = Informasi::find(3); // Ambil baris dengan ID 3
        $informasiTanggalMasuk = Informasi::find(4);
        $tanggal_daftar_ulang = $informasiDaftarUlang ? Carbon::parse($informasiDaftarUlang->tanggal_daftar_ulang) : null;
        $tanggal_masuk = $informasiTanggalMasuk ? Carbon::parse($informasiTanggalMasuk->tanggal) : null;

        if (!$tanggal_daftar_ulang || !$tanggal_masuk || !Carbon::now()->between($tanggal_daftar_ulang->startOfDay(), $tanggal_masuk->endOfDay())) {
            return response()->json(['success' => false, 'error' => 'Tidak dalam periode daftar ulang']);
        }

        if ($pendaftaran->status_pendaftaran === 'menunggu') {
            return response()->json(['success' => false, 'error' => 'Data siswa belum diproses, harap menunggu']);
        } elseif ($pendaftaran->status_pendaftaran === 'ditolak') {
            return response()->json(['success' => false, 'error' => 'Maaf, Anda belum lulus pendaftaran']);
        }

        return response()->json([
            'success' => true,
            'pendaftaran_id' => $pendaftaran->id,
            'nik' => $pendaftaran->nik,
            'nama' => $pendaftaran->nama
        ]);
    }


    public function store(Request $request)
    {
        // Validasi file yang diunggah
        $request->validate([
            'kartu_keluarga' => 'required|file',
            'akta_kelahiran' => 'required|file',
        ]);


        // Ambil pendaftaran terkait
        $pendaftaran_id = $request->input('pendaftaran_id');
        $pendaftaran = Pendaftaran::find($pendaftaran_id);

        // Susun nama berkas
        $nama_siswa = strtoupper($pendaftaran->nama); // Misalkan nama siswa disimpan dalam kolom 'nama'
        $nama_kk = $nama_siswa . '_KARTU_KELUARGA.' . $request->file('kartu_keluarga')->extension();
        $nama_akta = $nama_siswa . '_AKTE_KELAHIRAN.' . $request->file('akta_kelahiran')->extension();

        // Simpan berkas ke dalam penyimpanan publik
        $path_kk = $request->file('kartu_keluarga')->storeAs('berkas', $nama_kk, 'public');
        $path_akta = $request->file('akta_kelahiran')->storeAs('berkas', $nama_akta, 'public');

        // Cek apakah berkas sudah ada
        $existingBerkas = Berkas::where('pendaftaran_id', $pendaftaran_id)->first();

        if ($existingBerkas) {
            // Jika berkas ada, update entri database
            $existingBerkas->kartu_keluarga = $path_kk;
            $existingBerkas->akta_kelahiran = $path_akta;
            $existingBerkas->tanggal_pengumpulan = now();
            $existingBerkas->save();
        } else {
            // Jika tidak, buat entri database baru
            $berkas = new Berkas;
            $berkas->pendaftaran_id = $pendaftaran_id;
            $berkas->kartu_keluarga = $path_kk;
            $berkas->akta_kelahiran = $path_akta;
            $berkas->tanggal_pengumpulan = now();
            $berkas->save();
        }

        // Redirect atau tampilkan pesan sukses
        return redirect()->route('daftarulang.index')->with('success', 'Upload berkas Kartu Keluarga & Akta Kelahiran berhasil dikirim!');
    }


    // lolos
    public function accberkas($id)
    {
        $daftarulang = Berkas::find($id);
        $daftarulang->status_daftar_ulang = 'acc';
        $daftarulang->save();

        return response()->json(['status' => 'acc', 'message' => 'Daftar Ulang Berkas ACC (diterima)']);
    }

    // menunggu
    public function menungguberkas($id)
    {
        $daftarulang = Berkas::find($id);
        $daftarulang->status_daftar_ulang = 'menunggu';
        $daftarulang->save();

        return response()->json(['status' => 'menunggu', 'message' => 'Daftar Ulang Berkas menunggu']);
    }
}
