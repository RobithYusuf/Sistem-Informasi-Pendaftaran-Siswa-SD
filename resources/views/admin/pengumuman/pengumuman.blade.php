<x-app-layout title='Pengumuman'>
    <style>
        .button-container {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-container {
            display: flex;
            gap: 5px;
            /* Jarak antar tombol */
        }

        .btn {
            padding: 5px 10px;
            /* Menambahkan ruang di dalam tombol */
            font-size: 14px;
            /* Ukuran font tombol */
        }

        /* Responsivitas untuk tata letak tombol pada layar yang lebih kecil */
        @media (max-width: 576px) {
            .button-container {
                justify-content: flex-start;
                /* Tombol-tombol akan diletakkan di sebelah kiri pada layar yang lebih kecil */
            }

            .btn-container {
                flex-direction: column;
                /* Mengatur tombol-tombol secara vertikal */
            }
        }
    </style>


    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- main content -->
    <div class="container-fluid c-black position-relative">

        <!-- Page Heading -->
        <h2 class="mb-2 h3 text-gray-800  text-xs-center text-black">Data Pengumuman</h2>
        <p class="mb-4">Berisi Data Pengumuman yang telah melakukan pengisian data.</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Pengumuman</h6>
            </div>
            <div class="card-body">
                @if($pengumuman->count() > 0)
                @else
                <a href="{{ route ('pengumuman.create') }}" class="btn btn-primary mb-3">Tambah Data</a>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div id="notification" class="alert alert-success" style="display: none;">
                    Tambah file berhasil!
                </div>


                <div id="notification" class="alert" style="display:none"></div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Pengumuman</th>
                                <th>Tanggal Pengumuman</th>
                                <th>Keterangan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengumuman as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->judul_pengumuman }}</td>
                                <td>{{ $data->tanggal_pengumuman }}</td>
                                <td>{!! $data->keterangan !!}</td>
                                <td>
                                    <div class="button-container">
                                        <div class="btn-container">
                                            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#detailModal" data-id="{{ $data->id }}">Lihat</a>
                                            <a href="{{ route('pengumuman.edit', $data->id) }}" class="btn btn-warning">Edit</a>
                                            <a href="#" class="btn btn-sm btn-danger deleteLink" data-nama="{{ $data->judul_pengumuman }}" data-url="{{ route('pengumuman.hapus', $data->id) }}" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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

    <!-- Hapus modal konfirmasi -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel"><i class="fa fa-trash-o" aria-hidden="true"></i> Hapus Pengumuman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data <span id="judulPengumuman"></span>?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="deleteButton">Ya, Hapus</button>
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
            <div class="col-md-4 font-weight-bold ">Judul Pengumuman :</div>
            <div class="col-md-8" id="modalJudul"></div>
        </div>
        <div class="row mb-2">
            <div class="col-md-4 font-weight-bold">Tanggal Pengumuman :</div>
            <div class="col-md-8" id="modalTanggal"></div>
        </div>
        <div class="row mb-2">
            <div class="col-md-4 font-weight-bold">Keterangan Pengumuman :</div>
            <div class="col-md-8" id="modalKeterangan"></div>
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
                        $('#modalJudul').text(data.judul_pengumuman);
                        $('#modalTanggal').text(data.tanggal_pengumuman);
                        $('#modalKeterangan').text(data.keterangan);
                        $('#detailModal').modal('show');
                    },
                    error: function(error) {
                        console.error("Terjadi kesalahan:", error);
                    }
                });
            });
        });


        // Hapus data modal proses logic
        $(document).ready(function() {
            var deleteUrl;
            $(".deleteLink").on("click", function(e) {
                deleteUrl = $(this).data('url');
                var judulPengumuman = $(this).data('nama'); // Menggunakan 'data-nama' bukan 'data-judul_pengumuman'

                $("#judulPengumuman").text('"' + judulPengumuman + '"');
            });
in
            $("#deleteButton").on("click", function() {
                $.ajax({
                    url: deleteUrl,
                    type: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        location.reload();
                        // Tampilkan notifikasi setelah reload
                        localStorage.setItem("notification", response.success);
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
