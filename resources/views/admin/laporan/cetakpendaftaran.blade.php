<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Laporan Program</title>
    <style type="text/css" media="all">
        * {
            font-family: DejaVu Sans, sans-serif !important;
        }

        html {
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: auto;
            border: 1px solid #ededed;
        }

        table th {
            white-space: normal;
            overflow: hidden;
            text-overflow: ellipsis;
            border: 1px solid #ededed;
            padding: 5px;
            font-size: 8px;
            background-color: #ddd;
        }

        table td {
            word-wrap: break-word;
            overflow-wrap: break-word;
            /* Tambahkan baris ini */
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: normal;
            /* Ubah ini */
            border: 1px solid #ededed;
            padding: 5px;
            font-size: 8px;
            margin-bottom: 2rem;
        }

        .header {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            text-align: center;
            margin-bottom: 10px;

        }

        .title {
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .date {
            font-size: 8;
            margin-bottom: 5px;
        }



        .logo {
            width: 75px;
            height: 75px;
            margin-left: 15px;
        }

        .table-title {
            text-align: center;
            font-size: 13px;
        }

        .report-title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .report-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .report-period {
            font-size: 12px;
            color: #333;
            padding: 0;
            margin: 0;
        }

        .data-count {
            font-size: 12px;
            color: #333;
            padding: 0;
            margin: 0;
        }

        .report-period span,
        .data-count span {
            font-weight: bold;
        }

        footer {
            font-size: 10px;
        }

        .footer-style {
            margin-top: 4rem !important;
        }

        .footer-style1 {
            margin-top: 1rem !important;
        }

        .badge-custom {
      
            padding: 2px 5px;
            border-radius: 3px;
            font-size: 8px;
            font-weight: bold;
            display: inline-block;
        }

        .bg-warning-custom {
            background-color: #ffc107;
            text-align: center;
            color: #000;
            opacity: 0.8;
            /* Atur level transparansi di sini, contoh 0.8 */
        }

        .bg-success-custom {
            background-color: #28a745;
            text-align: center;
            color: #fff;
            opacity: 0.8;
            /* Atur level transparansi di sini, contoh 0.8 */
        }

        .bg-danger-custom {
            background-color: #dc3545;
            text-align: center;
            color: #fff;
            opacity: 0.8;
            /* Atur level transparansi di sini, contoh 0.8 */
        }
    </style>
</head>

<body>
    <div class="header">
        <table style="width: 100%; border: none;">
            <tr>
                <td style="width: 15%; text-align: left;">
                    <img src="{{ asset('assets/img/logo.png') }}" class="logo.png" alt="Logo Sekolah" style="width:100px; height:100px;">
                </td>
                <td style="width: 70%; text-align: center; margin-top:5px">
                    <div class="title">
                        <span class="pemerintahan">PEMERINTAHAN KABUPATEN BANTUL</span><br>
                        <span class="sekolah">SEKOLAH DASAR NEGERI 1 KRETEK</span><br>
                        <span class="alamat">Alamat : Tegalsari, Donotirto, Kec. Kretek, Kab. Bantul Prov. D.I. Yogyakarta</span>
                    </div>
                </td>
                <td style="width: 15%; text-align: right;">
                    <img src="{{ asset('assets/img/bantul.png') }}" alt="LogoBantul" style="width:100px; height:100px;">
                </td>
            </tr>
        </table>
        <hr style="border-top: 5px solid #000000;">
    </div>

    <div class="date">Tanggal dan Jam Laporan: {{ date('d/m/Y H:i') }}</div>
    <div class="report-title">Laporan Pendaftaran</div>
    <div class="report-info">
        <div class="report-period">
            Periode: <span>{{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }}</span> sampai <span>{{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</span>
        </div>
        <div class="data-count">
            Jumlah Data: <span>{{ $totalRows }}</span>
        </div>


    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama Siswa</th>
                <th>Jenis Kelamin</th>
                <th>Agama</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>Jumlah Saudara</th>
                <th>Anak Ke</th>
                <th>Tanggal Pendaftaran</th>
                <th>Status Pendaftaran</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $pendaftaran)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pendaftaran->nik }}</td>
                <td>{{ $pendaftaran->nama }}</td>
                <td>{{ $pendaftaran->jenis_kelamin }}</td>
                <td>{{ $pendaftaran->agama }}</td>
                <td>{{ $pendaftaran->tempat_lahir }}</td>
                <td>{{ $pendaftaran->tanggal_lahir }}</td>
                <td>{{ $pendaftaran->alamat }}</td>
                <td>{{ $pendaftaran->jumlah_saudara }}</td>
                <td>{{ $pendaftaran->anak_ke }}</td>
                <td>{{ $pendaftaran->created_at->format('Y-m-d') }}</td>

                <td>
                    @if ($pendaftaran->status_pendaftaran == 'menunggu')
                    <span class="badge badge-custom bg-warning-custom">{{ strtoupper($pendaftaran->status_pendaftaran) }}</span>
                    @elseif ($pendaftaran->status_pendaftaran == 'diterima')
                    <span class="badge badge-custom bg-success-custom">{{ strtoupper($pendaftaran->status_pendaftaran) }}</span>
                    @elseif ($pendaftaran->status_pendaftaran == 'ditolak')
                    <span class="badge badge-custom bg-danger-custom">{{ strtoupper($pendaftaran->status_pendaftaran) }}</span>
                    @endif
                </td>

            </tr>
            @empty
            <tr>
                <td colspan="12" style="text-align: center;"> Tidak ada data </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <footer>
        <br>
        <p style="text-align: right;" class="footer-style1">Tertanda,</p>
        <p class="footer-style" style="text-align: right; ">Panitia PPDB</p>
    </footer>

</body>

</html>
