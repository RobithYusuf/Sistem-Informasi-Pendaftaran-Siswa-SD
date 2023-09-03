<x-app-layout title='Data Wali'>
    <style>
        #dataTable td {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 250px;
        }

        #dataTable td.pengecekan {
            white-space: nowrap;
            overflow: visible;
            max-width: 70px;
            text-align: center;
        }

        .status-label:hover {
            opacity: 0.8;
            /* cursor: pointer; */
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


        .filter-container {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-top: 10px;
        }

        .filter-label {
            margin-right: 10px;
            font-weight: bold;
        }

        #status_filter {

            border: 1px solid #ced4da;
            border-radius: 4px;
            padding: 7px;
            width: 250px;
            font-size: 14px;
            margin-top: -8px;
        }

        /* Responsif untuk layar yang lebih kecil */
        @media (max-width: 768px) {
            .filter-container {
                flex-direction: column;
                align-items: flex-start;
                margin-top: 0;
            }

            .filter-label {
                margin-right: 0;
                margin-bottom: 5px;
            }

            #status_filter {
                width: 100%;
                margin-top: 0px;
            }

            .table-title {
                display: none;
                /* Sembunyikan teks "Tabel Pendaftaran" */
            }
        }
    </style>

    <!-- main content -->
    <div class="container-fluid c-black position-relative">
        <!-- <h5 class="mb-3 fw-bold text-xs-center text-black">Data Pendaftaran</h5 </div> -->
        <!-- Page Heading -->
        <h2 class="mb-2 h3 text-gray-800  text-xs-center text-black">Data Wali</h2>
        <p class="mb-4">Dibawah ini adalah Data Wali Siswa.</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">


            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Wali</h6>
            </div>



            <div class="card-body">
                <!-- <a href="#" class="btn btn-primary mb-3">Tambah Data</a> -->

                <div id="notification" class="alert" style="display:none"></div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Wali</th>
                                <th>Email Wali</th>
                                <th class="text-center">NIK Siswa</th>
                                <th>Nama Siswa</th>
                                <th>Pekerjaan Wali</th>
                                <th>Nomor HP Wali</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendaftaran as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->nama_wali }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->nik }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->pekerjaan_wali }}</td>
                                <td>{{ $data->no_hp }}</td>
                                <td class="pengecekan">
                                    <div class="pengecekan-buttons">
                                        <a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#detailModal" data-id="{{ $data->id }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        <a href="{{ route('datawali.edit', $data->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
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
                    <h5 class="modal-title" id="deleteModalLabel"><i class="fa fa-trash-o" aria-hidden="true"></i> Hapus Pendaftaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data <span id="siswaNama"></span>?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="deleteButton">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </div>


    <!-- modal untuk konfrimasi perubahan status -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Konfirmasi Aksi Perubahan Status Pendaftaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="confirmationModalBody">
                    <!-- Konten modal akan diubah di sini -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="confirmButton">Ya, Lanjutkan</button>
                </div>
            </div>
        </div>
    </div>


    @push('script')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    @endpush


    <x-modal-lihat-data title='Detail Pendaftaran'>


        <h4 class="mt-3 mb-3">Informasi Wali :</h4>
        <!-- Nama Wali -->
        <div class="row mb-2">
            <div class="col-md-4 font-weight-bold">Nama Wali :</div>
            <div class="col-md-8" id="modalNamaWali"></div>
        </div>

        <!-- Email -->
        <div class="row mb-2">
            <div class="col-md-4 font-weight-bold">Email :</div>
            <div class="col-md-8" id="modalEmail"></div>
        </div>

        <div class="row mb-2">
            <div class="col-md-4 font-weight-bold">Nomor Hp :</div>
            <div class="col-md-8" id="modalNomorHp"></div>
        </div>
        <!-- Pekerjaan Wali -->
        <div class="row mb-4">
            <div class="col-md-4 font-weight-bold">Pekerjaan Wali :</div>
            <div class="col-md-8" id="modalPekerjaanWali"></div>
        </div>


        <h4 class="mb-3">Informasi Siswa :</h4>
        <!-- NIK -->
        <div class="row mb-2">
            <div class="col-md-4 font-weight-bold ">NIK :</div>
            <div class="col-md-8" id="modalNIK"></div>
        </div>

        <!-- Nama -->
        <div class="row mb-2">
            <div class="col-md-4 font-weight-bold">Nama :</div>
            <div class="col-md-8" id="modalNama"></div>
        </div>

    </x-modal-lihat-data>


    <script>
        $(document).ready(function() {
            $(document).on('click', '.btn-info', function() {
                const id = $(this).data('id');
                $.ajax({
                    url: '/admin/pendaftaran/detail/' + id,
                    method: 'GET',
                    success: function(data) {
                        $('#modalID').text(data.id);
                        $('#modalNIK').text(data.nik);
                        $('#modalNama').text(data.nama);
                        $('#modalNamaWali').text(data.nama_wali);
                        $('#modalEmail').text(data.email);
                        $('#modalPekerjaanWali').text(data.pekerjaan_wali);
                        $('#modalNomorHp').text(data.no_hp);

                        $('#detailModal').modal('show');
                    },
                    error: function(error) {
                        console.error("Terjadi kesalahan:", error);
                    }
                });
            });
        });


        //reload kemudian notif
        // Ambil pesan dari sessionStorage
        var message = sessionStorage.getItem('notifMessage');

        // Jika pesan ada, tampilkan notifikasi
        if (message) {
            $('#notification').text(message)
                .addClass('alert-success')
                .show();

            setTimeout(function() {
                $('#notification').fadeOut();
            }, 1500);

            // Hapus pesan dari sessionStorage sehingga tidak ditampilkan lagi
            sessionStorage.removeItem('notifMessage');
        }



        //modal konfirmasi lolos, tidak lolos, menunggu
        $(document).ready(function() {
            var selectedUrl;

            $(".confirmationLink").on("click", function(e) {
                e.preventDefault();
                selectedUrl = $(this).data('url');

                if (selectedUrl.includes('diterima')) {
                    $("#confirmationModalBody").text("Apakah anda yakin ingin mengubah status pendaftaran menjadi 'Lolos' ?");
                } else if (selectedUrl.includes('ditolak')) {
                    $("#confirmationModalBody").text("Apakah anda yakin ingin mengubah status pendaftaran menjadi 'Tidak Lolos' ?");
                } else if (selectedUrl.includes('menunggu')) {
                    $("#confirmationModalBody").text("Apakah anda yakin ingin mengubah status pendaftaran menjadi 'Menunggu' ?");
                }

                $("#confirmationModal").modal("show");
            });

            $("#confirmButton").on("click", function() {
                $.ajax({
                    url: selectedUrl,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        var statusMessage;

                        switch (response.status) {
                            case 'diterima':
                                statusMessage = 'Pendaftaran lolos';
                                break;
                            case 'ditolak':
                                statusMessage = 'Pendaftaran tidak lolos';
                                break;
                            case 'menunggu':
                                statusMessage = 'Pendaftaran menunggu';
                                break;
                            default:
                                statusMessage = 'Status tidak diketahui';
                                break;
                        }

                        var message = "Status Pendaftaran berhasil diubah menjadi " + statusMessage;

                        // Simpan pesan ke dalam sessionStorage
                        sessionStorage.setItem('notifMessage', message);

                        // Segarkan halaman
                        location.reload();
                    },

                    error: function() {
                        // Menyegarkan halaman dengan parameter untuk menampilkan notifikasi
                        location.href = location.pathname + "?notif=error";
                    }
                });

                $("#confirmationModal").modal("hide"); // Menutup modal
            });
        });



        // Hapus data modal proses logic
        $(document).ready(function() {
            var deleteUrl;

            $(".deleteLink").on("click", function(e) {
                deleteUrl = $(this).data('url');
                var namaSiswa = $(this).data('nama'); // Mengambil nama siswa dari atribut data-nama

                $("#siswaNama").text('"' + namaSiswa + '"'); // Menetapkan nama siswa dalam modal
            });


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
