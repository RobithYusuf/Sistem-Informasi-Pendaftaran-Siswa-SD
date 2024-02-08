<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\PDF;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class LaporanController extends Controller
{

    public function index()
    {
        $pendaftaran = Pendaftaran::get();
        return view('admin.laporan.laporanpendaftaran', compact('pendaftaran'));
    }

    public function cetak(Request $request)
    {

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ], [
            'start_date.required' => 'Kolom tanggal mulai harus diisi.',
            'start_date.date' => 'Kolom tanggal mulai harus berupa tanggal.',
            'end_date.required' => 'Kolom tanggal selesai harus diisi.',
            'end_date.date' => 'Kolom tanggal selesai harus berupa tanggal.',
            'end_date.after_or_equal' => 'Kolom tanggal selesai harus setelah atau sama dengan tanggal mulai.',
        ]);


        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Ambil data berdasarkan filter tanggal
        $data = Pendaftaran::whereBetween('created_at', [$startDate, $endDate])->get();

        // Hitung jumlah baris
        $totalRows = $data->count();

        // Buat PDF menggunakan DOM PDF
        $pdf = app('dompdf.wrapper');
        $pdf = $pdf->loadView('admin.laporan.cetakpendaftaran', compact('data', 'startDate', 'endDate', 'totalRows'));

        return $pdf->stream('laporan Pendaftaran.pdf');
    }
}
