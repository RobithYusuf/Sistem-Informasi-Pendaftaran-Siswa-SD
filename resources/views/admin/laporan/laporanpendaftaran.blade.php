<x-app-layout title='Laporan Pendaftaran'>

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


        #status_filter {
            border: 1px solid #ced4da;
            border-radius: 4px;
            padding: 7px;
            width: 200px;
            /* Anda bisa menyesuaikan lebar ini */
            font-size: 14px;
            margin-top: -8px;
            margin-left: 10px;
            /* Tambahkan margin kiri untuk memberi jarak */
            background-color: #f8f9fa;
            /* Warna latar belakang */
            color: #343a40;
            /* Warna teks */
        }

        .date-filter {
            border: 1px solid #ced4da;
            border-radius: 4px;
            padding: 5px;
            width: 150px;
            font-size: 14px;
            margin-right: 10px;
        }

        .custom-btn {
            padding: 6px 15px;
            font-size: 14px;
            margin-left: 10px;
        }


        /* Responsif untuk layar yang lebih kecil */
        @media (max-width: 768px) {
            #status_filter {
                width: 100%;
                margin-top: 0px;
                margin-left: 0px;
                /* Hapus margin kiri untuk layar kecil */
            }

            .date-filter {
                width: 100%;
                margin-bottom: 5px;
            }

            .custom-btn {
                width: 100%;
                margin-left: 0;
                margin-top: 10px;
            }
        }
    </style>

    <!-- main content -->
    <div class="container-fluid c-black position-relative">
        <!-- Page Heading -->
        <h2 class="mb-2 h3 text-gray-800  text-xs-center text-black">Data Pendaftaran</h2>
        <p class="mb-4">Berisi Data Pendaftaran yang telah melakukan pengisian data.</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <div class="filter-container">
                    <h6 class="filter-label font-weight-bold text-primary" for="status_filter">Filter Laporan :</h6>
                    <label class="filter-label" for="start_date">Dari Tanggal:</label>
                    <input type="date" id="start_date" name="start_date" class="date-filter">
                    <label class="filter-label" for="end_date">Sampai Tanggal:</label>
                    <input type="date" id="end_date" name="end_date" class="date-filter">
                    <label class="filter-label" for="status_filter">Status Pendaftaran:</label>
                    <select id="status_filter">
                        <option value="">Semua</option>
                        <option value="DITERIMA">Lolos (Diterima)</option>
                        <option value="MENUNGGU">Menunggu</option>
                        <option value="DITOLAK">Tidak Lolos (Ditolak)</option>
                    </select>

                    <a href="#" id="cetak_laporan" class="btn btn-primary custom-btn">Cetak Laporan</a>

                </div>
            </div>

            <div class="card-body">

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <!-- <a href="#" class="btn btn-primary mb-3">Tambah Data</a> -->
                <div id="notification" class="alert" style="display:none"></div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th class="text-center">NIK</th>
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
                            @forelse($pendaftaran as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->nik }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->jenis_kelamin }}</td>
                                <td>{{ $data->agama }}</td>
                                <td>{{ $data->tempat_lahir }}</td>
                                <td>{{ $data->tanggal_lahir }}</td>
                                <td>{{ $data->alamat }}</td>
                                <td>{{ $data->jumlah_saudara }}</td>
                                <td>{{ $data->anak_ke }}</td>
                                <td>{{ $data->created_at->format('Y-m-d') }}</td> <!-- Diasumsikan tanggal pendaftaran adalah tanggal saat data dibuat -->
                                <td>
                                    @if ($data->status_pendaftaran == 'menunggu')
                                    <span class="badge status-label bg-warning text-light">{{ strtoupper($data->status_pendaftaran) }}</span>
                                    @elseif ($data->status_pendaftaran == 'diterima')
                                    <span class="badge status-label bg-success text-light">{{ strtoupper($data->status_pendaftaran) }}</span>
                                    @elseif ($data->status_pendaftaran == 'ditolak')
                                    <span class="badge status-label bg-danger text-light">{{ strtoupper($data->status_pendaftaran) }}</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="12" class="text-center">Tidak ada data</td>
                            </tr>
                            @endforelse

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


    <script>
        function updateCetakLink() {
            var startDate = $('#start_date').val();
            var endDate = $('#end_date').val();
            var status = $('#status_filter').val();
            var url = "{{ route('laporan.cetak') }}" + "?start_date=" + startDate + "&end_date=" + endDate + "&status_pendaftaran=" + status;
            $('#cetak_laporan').attr('href', url);
        }

        $(document).ready(function() {
            var table = $('#dataTable').DataTable();

            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); // Januari adalah 0!
            var yyyy = today.getFullYear();

            today = yyyy + '-' + mm + '-' + dd;
            document.getElementById('end_date').value = today;

            // Fungsi kustom untuk memfilter berdasarkan tanggal
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var startDate = new Date($('#start_date').val());
                    var endDate = new Date($('#end_date').val());

                    // Gantikan 10 dengan indeks kolom tanggal yang sesuai dalam tabel Anda
                    var dateColumn = new Date(data[10]);

                    if ((isNaN(startDate) && isNaN(endDate)) ||
                        (isNaN(startDate) && dateColumn <= endDate) ||
                        (startDate <= dateColumn && isNaN(endDate)) ||
                        (startDate <= dateColumn && dateColumn <= endDate)) {
                        return true;
                    }
                    return false;
                }
            );

            // Fungsi untuk filter status
            $('#status_filter').on('change', function() {
                var status = $(this).val();
                table.column(11).search(status).draw();
            });

            // Panggil fungsi updateCetakLink setiap kali filter berubah
            $('#start_date, #end_date, #status_filter').on('change', function() {
                updateCetakLink();
                table.draw();
            });
            updateCetakLink();
        });
    </script>

</x-app-layout>
