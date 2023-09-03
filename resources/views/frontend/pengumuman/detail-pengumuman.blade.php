@extends('frontend.index-form')
@section('judul','Detail Pengumuman')
@section('link_judul_halaman1','/pengumuman')
@section('nama_link_judul_halaman1','Halaman Pengumuman')
@section('content')

<style>
    .title {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .pengumuman-detail {
        font-family: Arial, sans-serif;
        line-height: 1.6;
    }

    section.detail-pengumuman {
        padding: 5px 0 !important;
    }

    p.pembukaan{
        margin-top: 2rem !important;
        margin-bottom: 1px !important;
    }

    .pengumuman-detail h1,
    .pengumuman-detail h5 {
        color: #333!important;
        font-family: Arial, sans-serif !important;
    }

    .pengumuman-detail .container {
        max-width: 1000px;
        margin: auto;
        padding: 25px;
        background: #f9f9f9;
        border: 1px solid #ddd;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .pengumuman-detail .lampiran-siswa table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1rem;
        background-color: #fff;
    }

    .pengumuman-detail .lampiran-siswa th,
    .pengumuman-detail .lampiran-siswa td {
        padding: 12px 15px;
        border: 1px solid #ddd;
        text-align: left;
    }

    .pengumuman-detail .lampiran-siswa th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    .pengumuman-detail .lampiran-siswa tr:nth-child(even) {
        background-color: #f8f8f8;
    }

    /* Responsif untuk tampilan mobile */
    @media screen and (max-width: 600px) {

        .pengumuman-detail .lampiran-siswa table,
        .pengumuman-detail .lampiran-siswa th,
        .pengumuman-detail .lampiran-siswa td {
            display: block;
            width: 100%;
        }

        .pengumuman-detail .lampiran-siswa td {
            border-top: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .pengumuman-detail .lampiran-siswa th {
            background: #f2f2f2;
            padding: 10px;
            text-align: left;
        }

        .pengumuman-detail .lampiran-siswa tr:nth-child(even) {
            background-color: #f8f8f8;
        }
    }

    .footer-style {
        margin-top: 2rem !important;
    }
    p.penutup{

        margin-top: 1px !important;
    }
</style>
<section id="pengumuman-detail" class="pengumuman-detail">
    <div class="container" data-aos="fade-up">

        <div class="header">
            <table style="width: 100%; border: none;">
                <tr>
                    <td style="width: 15%; text-align: left;">
                        <img src="../logo.png" alt="Logo Sekolah" style="width:100px; height:100px;">
                    </td>
                    <td style="width: 70%; text-align: center; margin-top:5px">
                        <div class="title">
                            <span class="pemerintahan">PEMERINTAHAN KABUPATEN BANTUL</span><br>
                            <span class="sekolah">SEKOLAH DASAR NEGERI 1 KRETEK</span><br>
                            <span class="alamat">Alamat : Tegalsari, Donotirto, Kec. Kretek, Kab. Bantul Prov. D.I. Yogyakarta</span>
                        </div>
                    </td>
                    <td style="width: 15%; text-align: right;">
                        <img src="../bantul.png" alt="LogoBantul" style="width:100px; height:100px;">
                    </td>
                </tr>
            </table>
            <hr style="border-top: 5px solid #000000;">
        </div>
        <div class="kop-surat text-center">
            <h1>{{ $pengumuman->judul_pengumuman }}</h1>
        </div>
        <div class="pengumuman-content">
            <p class="pembukaan">Selamat kepada seluruh siswa yang telah lolos menjadi siswa sekolah dasar negeri 1 Kretek.</p>
            <section class="detail-pengumuman" style="text-align: justify;">
                <p>{{ $pengumuman->keterangan }}</p>
                <p><strong>Infromasi jadwal daftar ulang untuk pengumpulan berkas :</strong> {{ \Carbon\Carbon::parse($informasiDaftarUlang->tanggal_daftar_ulang)->format('d-m-Y') }}</p>
                <p><strong>Informasi lainya :</strong> {{ $informasiSiswaMasuk->judul_informasi }} Pada Tanggal {{ \Carbon\Carbon::parse($informasiSiswaMasuk->tanggal)->format('d-m-Y') }}</p>
            </section>
            <footer>
                <p class="penutup" style="text-align: justify;">Terima kasih kepada semua pihak yang telah mendukung proses ini. Kami berharap kepada seluruh siswa yang lolos untuk terus mengembangkan potensi dan berkontribusi dalam sekolah kami. Selamat bergabung di Sekolah Dasar Negeri 1 Kretek.</p>
                <p style="text-align: right;">Tertanda,</p>
                <p class="footer-style" style="text-align: right; ">Panitia PPDB</p>
            </footer>
        </div>


        <div class="lampiran-siswa text-center">
            <h5>Lampiran Daftar Siswa Diterima:</h5>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendaftaran as $siswa)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $siswa->nama }}</td>
                        <td>{{ $siswa->alamat }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
</section>
@endsection
