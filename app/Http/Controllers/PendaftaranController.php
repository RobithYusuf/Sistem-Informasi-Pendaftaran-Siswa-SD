<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    //admin
    public function index()
    {
        $pendaftaran = Pendaftaran::orderBy('created_at', 'desc')->get();
        return view('admin.pendaftaran.pendaftaran', compact('pendaftaran'));
    }

    //admin datawali
    public function indexwali()
    {
        $pendaftaran = Pendaftaran::orderBy('created_at', 'desc')->get();
        return view('admin.datawali.wali', compact('pendaftaran'));
    }

    //guest
    public function create()
    {
        return view('frontend.pendaftaran.form-pendaftaran', ['showHasil' => false]);
    }
    //guest
    public function store(Request $request)
    {

        // Validasi data yang masuk
        $request->validate(
            [
                'nik' => 'required|unique:pendaftaran,nik|max:16',
                'nama' => 'required|max:50',
                'jenis_kelamin' => 'required|max:25',
                'agama' => 'required|max:50',
                'tempat_lahir' => 'required|max:50',
                'tanggal_lahir' => 'required|date',
                'alamat' => 'required',
                'jumlah_saudara' => 'required|integer',
                'anak_ke' => 'required|integer',
                'nama_wali' => 'required|max:50',
                'email' => 'required|email|max:55',
                'no_hp' => 'required|max:50',
                'pekerjaan_wali' => 'nullable|max:55',
            ],
            [
                'nik.required' => 'NIK wajib diisi',
                'nik.unique' => 'NIK ini sudah terdaftar',
                'nik.max' => 'NIK tidak boleh lebih dari 16 karakter',
                'nama.required' => 'Nama wajib diisi',
                'nama.max' => 'Nama tidak boleh lebih dari 50 karakter',
                'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
                'jenis_kelamin.max' => 'Jenis kelamin tidak boleh lebih dari 25 karakter',
                'agama.required' => 'Agama wajib diisi',
                'agama.max' => 'Agama tidak boleh lebih dari 50 karakter',
                'tempat_lahir.required' => 'Tempat lahir wajib diisi',
                'tempat_lahir.max' => 'Tempat lahir tidak boleh lebih dari 50 karakter',
                'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
                'tanggal_lahir.date' => 'Format tanggal lahir tidak valid',
                'alamat.required' => 'Alamat wajib diisi',
                'jumlah_saudara.required' => 'Jumlah saudara wajib diisi',
                'jumlah_saudara.integer' => 'Jumlah saudara harus berupa angka',
                'anak_ke.required' => 'Anak ke- wajib diisi',
                'anak_ke.integer' => 'Anak ke- harus berupa angka',
                'nama_wali.required' => 'Nama wali wajib diisi',
                'nama_wali.max' => 'Nama wali tidak boleh lebih dari 50 karakter',
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Format email tidak valid',
                'email.max' => 'Email tidak boleh lebih dari 55 karakter',
                'no_hp.required' => 'No HP wajib diisi',
                'no_hp.max' => 'No HP tidak boleh lebih dari 50 karakter',
                'pekerjaan_wali.max' => 'Pekerjaan wali tidak boleh lebih dari 55 karakter',
            ]
        );

        $tanggal_lahir = Carbon::createFromFormat('d-m-Y', $request->input('tanggal_lahir'))->format('Y-m-d');
        Pendaftaran::create(array_merge($request->all(), ['tanggal_lahir' => $tanggal_lahir]));
        return redirect()->route('pendaftaran.submit')->with('success', 'Pendaftaran berhasil disimpan!');
    }

    public function cekNIK(Request $request)
    {
        $nik = $request->input('nik');
        $exists = Pendaftaran::where('nik', $nik)->exists();
        return response()->json(['exists' => $exists]);
    }

    //guest landing page
    public function hasil()
    {
        $pendaftaran = Pendaftaran::orderBy('created_at', 'desc')->take(25)->get();
        return view('frontend.pendaftaran.hasil-pendaftaran', compact('pendaftaran'), ['showHasil' => true]);
    }

    //guest
    public function hasilNik($nik)
    {
        $pendaftaran = Pendaftaran::where('nik', $nik)->get();
        return response()->json($pendaftaran);
    }

    //admin lihat data
    public function detail($id)
    {
        $pendaftaran = Pendaftaran::find($id);
        if (!$pendaftaran) {
            return response()->json(['error' => 'Pendaftaran tidak ditemukan'], 404);
        }
        return response()->json($pendaftaran);
    }

    //edit
    public function edit(Pendaftaran $pendaftaran)
    {
        return view('admin.pendaftaran.edit', compact('pendaftaran'));
    }
    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        // Anda bisa menambahkan validasi sama seperti di method `store`
        $pendaftaran->update($request->all());
        return redirect()->route('pendaftaran.index')->with('success', 'Data pendaftaran berhasil diperbarui.');
    }

    //edit data wali
    public function editwali(Pendaftaran $pendaftaran)
    {
        return view('admin.datawali.edit', compact('pendaftaran'));
    }
    public function updatewali(Request $request, Pendaftaran $pendaftaran)
    {
        // Anda bisa menambahkan validasi sama seperti di method `store`
        $pendaftaran->update($request->all());
        return redirect()->route('datawali.index')->with('success', 'Data Wali berhasil diperbarui.');
    }

    // lolos
    public function diterima($id)
    {
        $pendaftaran = Pendaftaran::find($id);
        $pendaftaran->status_pendaftaran = 'diterima';
        $pendaftaran->save();

        return response()->json(['status' => 'diterima', 'message' => 'Pendaftaran lolos (diterima)']);
    }
    // tidak lolos
    public function ditolak($id)
    {
        $pendaftaran = Pendaftaran::find($id);
        $pendaftaran->status_pendaftaran = 'ditolak';
        $pendaftaran->save();

        return response()->json(['status' => 'ditolak', 'message' => 'Pendaftaran di tolak (tidak lolos)']);
    }
    // menunggu
    public function menunggu($id)
    {
        $pendaftaran = Pendaftaran::find($id);
        $pendaftaran->status_pendaftaran = 'menunggu';
        $pendaftaran->save();

        return response()->json(['status' => 'menunggu', 'message' => 'Pendaftaran menunggu']);
    }
    //hapus
    public function hapus($id)
    {
        $pendaftaran = Pendaftaran::find($id);

        if (!$pendaftaran) {
            return response()->json(['error' => 'Pendaftaran tidak ditemukan'], 404);
        }

        // Hapus Berkas terkait, jika ada
        if ($pendaftaran->berkas) {
            $pendaftaran->berkas->delete();
        }


        // Hapus pendaftaran
        $pendaftaran->delete();

        return response()->json(['success' => 'Pendaftaran dan semua data terkait berhasil dihapus']);
    }
}
