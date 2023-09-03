@extends('frontend.index-form')
@section('judul', 'Hasil Pendaftaran')
@section('link_judul_halaman1', route('pendaftaran.hasil'))
@section('nama_link_judul_halaman1', 'Hasil Pendaftaran')

@section('content')
<style>
    td {
        max-width: 500px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .form-text.keterangan {
        font-size: 13px;
        margin-left: 0.5rem;
        color: red !important;
        font-style: italic;
    }

    .search-input {
        margin-bottom: -2px;
    }
</style>

<section id="pendaftaran" class="contact bg-light py-5">
    <div class="container" data-aos="fade-up">
        <div class="section-title text-center">
            <h2>Data Hasil Pendaftaran</h2>
            <p>Untuk data siswa yang sudah sesuai harap menunggu sampai tanggal pengumuman, jika ada kesalahan harap menghubungi admin.</p>
        </div>
        <!-- Input Pencarian NIK -->
        <div class="row mb-4">
            <div class="col-md-8 offset-md-2">
                <div class="input-group">
                    <input type="text" class="form-control search-input" id="searchNIK" placeholder="Masukkan 16 digit NIK untuk pencarian data yang lebih lengkap" maxlength="16">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" id="buttonSearch"> <i class="bi bi-search"></i> Cari</button>
                        <button class="btn btn-secondary" type="button" id="buttonRefresh"><i class="bi bi-arrow-clockwise"></i> Refresh</button>
                    </div>
                </div>
                <small class="form-text keterangan text-muted" style="color: red;">*Pastikan anda mengisi NIK dengan benar !</small>
            </div>
        </div>
        <div id="notification" class="alert alert-success" style="display: none;">
            Pencarian berhasil ditemukan!
        </div>


        <div class="table-responsive">
            <table class="table">
                <thead id="tableHeaderBeforeSearch">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">NIK</th>
                        <th scope="col">Nama Lengkap Siswa</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Tempat Lahir</th>
                        <th scope="col" class="text-center">Tanggal Pendaftaran</th>
                        <!-- <th scope="col" class="text-center">Status Pendaftaran</th> -->

                    </tr>
                </thead>
                <thead id="tableHeaderAfterSearch" style="display: none;">
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Agama</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Jumlah Saudara</th>
                    <th>Anak Ke</th>
                    <th>Nama Wali</th>
                    <th>Email Wali</th>
                    <th>Pekerjaan Wali</th>
                    <th>Tanggal Pendaftaran</th>
                    <!-- <th>Status Pendaftaran</th> -->
                </thead>
                <tbody id="tableBody">
                    @foreach($pendaftaran as $pendaftar)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ substr($pendaftar->nik, 0, 4) }}....</td>
                        <td>{{ $pendaftar->nama }}</td>
                        <td>{{ $pendaftar->jenis_kelamin }}</td>
                        <td>{{ $pendaftar->tempat_lahir }}</td>
                        <td class="text-center">{{ $pendaftar->created_at->format('d-m-Y H:i') }}</td>
                        <!-- <td class="text-center">
                            @if ($pendaftar->status_pendaftaran == 'menunggu')
                            <span class="badge status-label bg-warning text-light">{{ strtoupper($pendaftar->status_pendaftaran) }}</span>
                            @elseif ($pendaftar->status_pendaftaran == 'diterima')
                            <span class="badge status-label bg-success text-light">{{ strtoupper($pendaftar->status_pendaftaran) }}</span>
                            @elseif ($pendaftar->status_pendaftaran == 'ditolak')
                            <span class="badge status-label bg-danger text-light">{{ strtoupper($pendaftar->status_pendaftaran) }}</span>
                            @endif
                        </td> -->
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</section>

<script>
    $('#buttonSearch').click(function() {
        var nik = $('#searchNIK').val();
        if (nik.length < 10 || nik.length > 16) {
            alert('Silakan masukkan NIK yang valid (1 hingga 16 digit)');
            return;
        }
        $.get('/pendaftaran/hasil/' + nik, function(data) {
                if (data.length === 0) { // Jika data kosong
                    alert('Error: NIK tidak ditemukan');
                    $('#notification').hide(); // Sembunyikan notifikasi
                    // Kembalikan tabel ke keadaan semula
                    $('#tableHeaderBeforeSearch').show();
                    $('#tableHeaderAfterSearch').hide();
                    $('#tableBody').empty(); // Kosongkan body tabel
                } else {
                    $('#notification').show(); // Tampilkan notifikasi
                    $('#tableHeaderBeforeSearch').hide();
                    $('#tableHeaderAfterSearch').show();
                    $('#tableBody').empty();
                    $.each(data, function(index, pendaftar) {
                        function formatDate(dateString) {
                            var options = {
                                year: 'numeric',
                                month: '2-digit',
                                day: '2-digit',
                                hour: '2-digit',
                                minute: '2-digit'
                            };
                            return new Date(dateString).toLocaleDateString('id-ID', options);
                        }
                        var statusHTML = '';
                        if (pendaftar.status_pendaftaran == 'menunggu') {
                            statusHTML = '<span class="badge status-label bg-warning text-light">' + pendaftar.status_pendaftaran.toUpperCase() + '</span>';
                        } else if (pendaftar.status_pendaftaran == 'diterima') {
                            statusHTML = '<span class="badge status-label bg-success text-light">' + pendaftar.status_pendaftaran.toUpperCase() + '</span>';
                        } else if (pendaftar.status_pendaftaran == 'ditolak') {
                            statusHTML = '<span class="badge status-label bg-danger text-light">' + pendaftar.status_pendaftaran.toUpperCase() + '</span>';
                        }
                        $('#tableBody').append(
                            '<tr>' +
                            '<td>' + pendaftar.nik + '</td>' +
                            '<td>' + pendaftar.nama + '</td>' +
                            '<td>' + pendaftar.jenis_kelamin + '</td>' +
                            '<td>' + pendaftar.agama + '</td>' +
                            '<td>' + pendaftar.tempat_lahir + '</td>' +
                            '<td>' + pendaftar.tanggal_lahir + '</td>' +
                            '<td>' + pendaftar.alamat + '</td>' +
                            '<td>' + pendaftar.jumlah_saudara + '</td>' +
                            '<td>' + pendaftar.anak_ke + '</td>' +
                            '<td>' + pendaftar.nama_wali + '</td>' +
                            '<td>' + pendaftar.email + '</td>' +
                            '<td>' + pendaftar.pekerjaan_wali + '</td>' +
                            '<td>' + formatDate(pendaftar.created_at) + '</td>' +
                            // '<td class="text-center">' + statusHTML + '</td>' +
                            '</tr>'
                        );
                    });
                }
            })
            .fail(function() {
                $('#notification').hide();
                $('#tableHeaderBeforeSearch').show();
                $('#tableHeaderAfterSearch').hide();
                alert('Silakan masukkan NIK yang valid (1 hingga 16 digit)');
            });
    });

    $("#buttonRefresh").click(function() {

        location.reload();
    });
</script>
@endsection
