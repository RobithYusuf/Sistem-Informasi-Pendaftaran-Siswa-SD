<x-app-layout title='Daftar Ulang'>
    <style>
        #dataTable td {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 130px;
        }

        #dataTable td.pengecekan {
            white-space: nowrap;
            overflow: visible;
            max-width: 420px;
            text-align: center;
        }

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

        /* thumbnaik akta dan kk */
        .thumbnail-link {
            display: inline-block;
            /* background-color: #f3f3f3; */
            border-radius: 8px;

            transition: all 0.3s ease;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
        }

        .thumbnail-link:hover {
            transform: scale(1.05);
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
        }

        .img-thumbnail {

            width: 50px;
            height: 50px;
            object-fit: cover;
        }


        /* filter */
        .filter-container {
            display: flex;

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

        <!-- Page Heading -->
        <h2 class="mb-2 h3 text-gray-800  text-xs-center text-black">Data Berkas</h2>
        <p class="mb-4">Berisi Data Berkas dari proses daftar ulang ketika sudah uplaod berkas. ditampilkan di halaman depan (landing page).</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="filter-container">
                    <h6 class="filter-label font-weight-bold text-primary" for="status_filter">Filter Status Daftar Ulang :</h6>
                    <select id="status_filter">
                        <option value="">Semua</option>
                        <option value="ACC">Acc (Diterima) </option>
                        <option value="MENUNGGU">Menunggu </option>
                    </select>
                </div>
            </div>
            <div class="card-body">
                <!-- <a href="#" class="btn btn-primary mb-3">Tambah Data</a> -->
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                <div id="notification" class="alert" style="display:none"></div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Nama Siswa</th>
                                <th class="text-center">Kartu Keluarga</th>
                                <th class="text-center">Akte Kelahiran</th>
                                <th class="text-center">Tanggal Pengumpulan</th>
                                <th class="text-center">Status Daftar Ulang</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($berkas as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->pendaftaran->nik ?? '-' }}</td>
                                <td>{{ $data->pendaftaran->nama ?? '-' }}</td>
                                <td class="text-center">
                                    <a href="{{ asset('storage/berkas/' . basename($data->kartu_keluarga)) }}" target="_blank" class="thumbnail-link">
                                        @if(pathinfo($data->kartu_keluarga, PATHINFO_EXTENSION) == 'pdf')
                                        <img src="{{ asset('pdf.png') }}" alt="Kartu Keluarga" class="img-thumbnail">
                                        @else
                                        <img src="{{asset('storage/'. $data->kartu_keluarga) }}" alt="Kartu Keluarga" class="img-thumbnail">
                                        @endif
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="{{ asset('storage/berkas/' . basename($data->akta_kelahiran)) }}" target="_blank" class="thumbnail-link">
                                        @if(pathinfo($data->akta_kelahiran, PATHINFO_EXTENSION) == 'pdf')
                                        <img src="{{ asset('pdf.png') }}" alt="Kartu Keluarga" class="img-thumbnail">
                                        @else
                                        <img src="{{asset('storage/'. $data->akta_kelahiran) }}" alt="Kartu Keluarga" class="img-thumbnail">
                                        @endif
                                    </a>
                                </td>
                                <td class="no-wrap text-center">{{ $data->tanggal_pengumpulan ? \Carbon\Carbon::parse($data->tanggal_mulai)->format('d M Y') : '-' }}</td>
                                <td class="text-center">
                                    @if ($data->status_daftar_ulang == 'menunggu')
                                    <span class="badge status-label bg-warning text-light">{{ strtoupper($data->status_daftar_ulang) }}</span>
                                    @elseif ($data->status_daftar_ulang == 'acc')
                                    <span class="badge status-label bg-success text-light">{{ strtoupper($data->status_daftar_ulang) }}</span>
                                    @endif
                                </td>

                                <td class="pengecekan">
                                    <div class="pengecekan-buttons">
                                        <a href="#" class="btn btn-sm btn-success confirmationLink" data-url="{{ route('daftarulang.acc', $data->id) }}">Acc</a>
                                        <a href="#" class="btn btn-sm btn-dark confirmationLink" data-url="{{ route('daftarulang.menunggu', $data->id) }}">Menunggu</a>
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

    @push('script')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    @endpush

    <!-- filter -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var table = $('#dataTable').DataTable();

            function getParameterByName(name) {
                var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
                return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
            }
            var status = getParameterByName('status');
            if (status) {
                document.getElementById('status_filter').value = status.toUpperCase();
                table.column(6).search(status.toUpperCase()).draw(); // Gantikan 14 dengan indeks kolom status pendaftaran yang sesuai
            }
            $('#status_filter').on('change', function() {
                var status = $(this).val();
                table.column(6).search(status).draw();
            });
        });
    </script>


    <!-- modal untuk konfrimasi perubahan status -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Konfirmasi Aksi Perubahan Status Dafatr Ulang Berkas</h5>
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


    <script>
        var message = sessionStorage.getItem('notifMessage');

        // Jika pesan ada, tampilkan notifikasi
        if (message) {
            $('#notification').text(message)
                .addClass('alert-success')
                .show();
            setTimeout(function() {
                $('#notification').fadeOut();
            }, 2000);

            // Hapus pesan dari sessionStorage sehingga tidak ditampilkan lagi
            sessionStorage.removeItem('notifMessage');
        }
        //modal konfirmasi lolos, tidak lolos, menunggu
        $(document).ready(function() {
            var selectedUrl;
            $(".confirmationLink").on("click", function(e) {
                e.preventDefault();
                selectedUrl = $(this).data('url');

                if (selectedUrl.includes('acc')) {
                    $("#confirmationModalBody").text("Apakah anda yakin ingin mengubah status daftar ulang menjadi 'ACC' ?");
                } else if (selectedUrl.includes('menunggu')) {
                    $("#confirmationModalBody").text("Apakah anda yakin ingin mengubah status daftar ulang menjadi 'Menunggu' ?");
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
                            case 'acc': // Ubah ini untuk mencocokkan dengan respons dari server
                                statusMessage = 'Daftar Ulang ACC';
                                break;
                            case 'menunggu':
                                statusMessage = 'Daftar Ulang Menunggu';
                                break;
                            default:
                                statusMessage = 'Status tidak diketahui';
                                break;
                        }


                        var message = "Status Daftar Ulang berhasil diubah menjadi " + statusMessage;

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
    </script>



</x-app-layout>
