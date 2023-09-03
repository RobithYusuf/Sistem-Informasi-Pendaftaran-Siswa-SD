<x-app-layout title='Pendaftaran'>
    <style>
        th.no-wrap {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 150px;
        }

        td.no-wrap {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 150px;
        }

        .status-label:hover {
            opacity: 0.8;
        }

        .bg-warning-light {
            background-color: #ffeeba;
            color: #856404;
            padding: 0.2rem 0.5rem;
            border-radius: 0.25rem;
        }

        .bg-success-light {
            background-color: #d4edda;
            color: #155724;
            padding: 0.2rem 0.5rem;
            border-radius: 0.25rem;
        }

        .bg-danger-light {
            background-color: #f8d7da;
            color: #721c24;
            padding: 0.2rem 0.5rem;
            border-radius: 0.25rem;
        }
    </style>

    <!-- main content -->
    <div class="container-fluid c-black position-relative">

        <!-- Page Heading -->
        <h2 class="mb-2 h3 text-gray-800  text-xs-center text-black">Data Jadwal</h2>
        <p class="mb-4">Berisi Data Jadwal untuk ditampilkan di halaman depan (landing page).</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Pendaftaran</h6>
            </div>
            <div class="card-body">
                <!-- <a href="#" class="btn btn-primary mb-3">Tambah Data</a> -->
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Informasi</th>
                                <th>Deskripsi Jadwal</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Tanggal Pengumuman</th>
                                <th>Tanggal Daftar Ulang</th>
                                <th>Tanggal </th>

                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($informasi as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->judul_informasi ?? '-' }}</td>
                                <td>{{ $data->detail ?? '-' }}</td>
                                <td class="no-wrap text-center">{{ $data->tanggal_mulai ? \Carbon\Carbon::parse($data->tanggal_mulai)->format('d M Y') : '-' }}</td>
                                <td class="no-wrap text-center">{{ $data->tanggal_selesai ? \Carbon\Carbon::parse($data->tanggal_selesai)->format('d M Y') : '-' }}</td>
                                <td class="no-wrap text-center">{{ $data->tanggal_pengumuman ? \Carbon\Carbon::parse($data->tanggal_pengumuman)->format('d M Y') : '-' }}</td>
                                <td class="no-wrap text-center">{{ $data->tanggal_daftar_ulang ? \Carbon\Carbon::parse($data->tanggal_daftar_ulang)->format('d M Y') : '-' }}</td>
                                <td class="no-wrap text-center">{{ $data->tanggal ? \Carbon\Carbon::parse($data->tanggal)->format('d M Y') : '-' }}</td>
                                <td>
                                    <a href="{{ route('informasi.edit', $data->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('script')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    @endpush

    <x-modal-lihat-data title='Detail Pengumuman'>
        <div class="row mb-2">
            <div class="col-md-4 font-weight-bold ">NIK :</div>
            <div class="col-md-8" id="modalNIK"></div>
        </div>
        <div class="row mb-2">
            <div class="col-md-4 font-weight-bold">Nama Siswa :</div>
            <div class="col-md-8" id="modalNama"></div>
        </div>
        <div class="row mb-2">
            <div class="col-md-4 font-weight-bold">Status Pendaftaran :</div>
            <div class="col-md-8" id="modalStatusPendaftaran"></div>
        </div>
        <div class="row mb-2">
            <div class="col-md-4 font-weight-bold">Tanggal Pendaftaran :</div>
            <div class="col-md-8" id="modalTanggalPendaftaran"></div>
        </div>
        <div class="row mb-2">
            <div class="col-md-4 font-weight-bold">Alamat :</div>
            <div class="col-md-8" id="modalAlamat"></div>
        </div>
    </x-modal-lihat-data>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.btn-info', function() {
                const id = $(this).data('id');
                $.ajax({
                    url: '/admin/pengumuman/detail/' + id,
                    method: 'GET',
                    success: function(data) {
                        $('#modalID').text(data.id);
                        $('#modalNIK').text(data.pendaftaran.nik);
                        $('#modalNama').text(data.pendaftaran.nama);
                        $('#modalAlamat').text(data.pendaftaran.alamat);

                        let rawDate = data.pendaftaran.created_at;
                        let dateObj = new Date(rawDate);
                        let formattedDate = dateObj.toLocaleDateString('en-GB') + ' ' + dateObj.getHours() + ':' + ('0' + dateObj.getMinutes()).slice(-2);
                        $('#modalTanggalPendaftaran').text(formattedDate);

                        let statusLabel = '';
                        switch (data.pendaftaran.status_pendaftaran) {
                            case 'menunggu':
                                statusLabel = '<span class="bg-warning-light">' + data.pendaftaran.status_pendaftaran.toUpperCase() + '</span>';
                                break;
                            case 'diterima':
                                statusLabel = '<span class="bg-success-light">' + data.pendaftaran.status_pendaftaran.toUpperCase() + '</span>';
                                break;
                            case 'ditolak':
                                statusLabel = '<span class="bg-danger-light">' + data.pendaftaran.status_pendaftaran.toUpperCase() + '</span>';
                                break;
                            default:
                                statusLabel = data.pendaftaran.status_pendaftaran;
                        }
                        $('#modalStatusPendaftaran').html(statusLabel);
                        $('#detailModal').modal('show');
                    },
                    error: function(error) {
                        console.error("Terjadi kesalahan:", error);
                    }
                });
            });
        });
    </script>

</x-app-layout>