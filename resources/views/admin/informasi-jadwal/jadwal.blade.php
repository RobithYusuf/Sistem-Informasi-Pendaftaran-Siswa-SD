<x-app-layout title='Kelola Jadwal'>
    <style>
        .button-container {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-container {
            display: flex;
            gap: 5px;
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
                <a href="{{ route ('informasi.create') }}" class="btn btn-primary mb-3">Tambah Data</a>
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
                <div id="notification" class="alert" style="display:none"></div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kegiatan</th>
                                <th>Deskripsi</th>
                                <th>Jenis Informasi</th>
                                <th class="text-center">Tanggal Mulai</th>
                                <th class="text-center">Tanggal Selesai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($informasi as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->kegiatan ?? '-' }}</td>
                                <td>{{ $data->deskripsi ?? '-' }}</td>
                                <td>{{ UCfirst($data->jenis ?? '-') }}</td>
                                <td class="no-wrap text-center">{{ $data->tanggal_mulai ? \Carbon\Carbon::parse($data->tanggal_mulai)->format('d M Y') : '-' }}</td>
                                <td class="no-wrap text-center">{{ $data->tanggal_selesai ? \Carbon\Carbon::parse($data->tanggal_selesai)->format('d M Y') : '-' }}</td>
                                <td>
                                    <div class="button-container">
                                        <div class="btn-container">
                                            <a href="{{ route('informasi.edit', $data->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="#" class="btn btn-sm btn-danger deleteLink" data-nama="{{ $data->kegiatan }}" data-url="{{ route('informasi.hapus', $data->id) }}" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus <span id="deleteItemName"></span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <form method="POST" id="deleteForm">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
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

        //hapus
        $(document).ready(function() {
            var deleteUrl;

            $(".deleteLink").on("click", function(e) {
                e.preventDefault(); // Prevent the link from navigating

                deleteUrl = $(this).data('url');
                var deleteItemName = $(this).data('nama');

                $("#deleteItemName").text('"' + deleteItemName + '"');
            });

            $("#deleteForm").on("submit", function(e) {
                e.preventDefault();

                $.ajax({
                    url: deleteUrl,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        localStorage.setItem("notification", response.success);

                        setTimeout(function() {
                            location.reload();
                        }, 600); // Delay reload untuk 1 detik
                    },


                    error: function() {
                        alert("Terjadi kesalahan. Silakan coba lagi.");
                    }
                });

                $("#deleteModal").modal("hide");
            });

            var notification = localStorage.getItem("notification");
            if (notification) {
                $('#notification').text(notification);
                $('#notification').addClass('alert-success');
                $('#notification').show();

                // Menghilangkan notifikasi setelah 5 detik
                setTimeout(function() {
                    $('#notification').hide();
                }, 5000);

                localStorage.removeItem("notification");
            }
        });
    </script>

</x-app-layout>
