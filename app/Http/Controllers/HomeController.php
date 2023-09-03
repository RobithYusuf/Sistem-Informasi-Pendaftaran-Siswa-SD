<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\Informasi;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $totalPendaftar = Pendaftaran::count();
        $diterima = Pendaftaran::where('status_pendaftaran', 'diterima')->count();
        $menunggu = Pendaftaran::where('status_pendaftaran', 'menunggu')->count();
        $ditolak = Pendaftaran::where('status_pendaftaran', 'ditolak')->count();
        $totalDaftarUlang = Berkas::count();
        $accberkas = Berkas::where('status_daftar_ulang', 'acc')->count();
        $berkasmenunggu = Berkas::where('status_daftar_ulang', 'menunggu')->count();

        // jadwal
        $informasiPendaftaran = Informasi::find(1);
        $informasiPengumuman = Informasi::find(2);
        $informasiDaftarUlang = Informasi::find(3);
        $informasiTanggalMasuk = Informasi::find(4);

        return view('admin.dashboard.dashboard', compact('totalPendaftar', 'diterima', 'menunggu', 'ditolak', 'totalDaftarUlang', 'accberkas', 'berkasmenunggu', 'informasiPendaftaran', 'informasiPengumuman', 'informasiDaftarUlang', 'informasiTanggalMasuk'));
    }
}
