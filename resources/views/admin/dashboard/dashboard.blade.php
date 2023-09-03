<x-app-layout title='Dashboard'>

    <style>
        .card {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card.border-left-primary:hover {
            border-left-color: #004085;
        }

        .card.border-left-success:hover {
            border-left-color: #155724;
        }

        .card.border-left-info:hover {
            border-left-color: #0c5460;
        }

        .card.border-left-danger:hover {
            border-left-color: #721c24;
        }

        .card.border-left-secondary:hover {
            border-left-color: #383d41;
        }

        .card.border-left-warning:hover {
            border-left-color: #856404;
        }
    </style>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard Admin</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
        </div>



        <!-- Content Row -->
        <h5 class="mb-3 h5 text-gray-800  text-xs-center text-black">Widget Pendaftaran Siswa</h5>
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ url('/admin/pendaftaran') }}" class="text-decoration-none">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Keseluruhan Pendaftar</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPendaftar }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>

                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>


            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ url('/admin/pendaftaran?status=diterima') }}" class="text-decoration-none">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Siswa Lolos (Diterima)</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $diterima }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-check-circle fa-2x text-gray-300"></i>

                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ url('/admin/pendaftaran?status=menunggu') }}" data-status="menunggu" class="text-decoration-none filter-link">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pendaftar Baru (Menunggu)
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $menunggu }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-hourglass-half fa-2x text-gray-300"></i>

                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ url('/admin/pendaftaran?status=ditolak') }}" data-status="ditolak" class="text-decoration-none filter-link">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        Pendaftar Tidak Lolos</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $ditolak }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-times-circle fa-2x text-gray-300"></i>

                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>



        </div>

        <h5 class="mb-3 h5 text-gray-800  text-xs-center text-black">Widget Daftar Ulang</h5>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ url('/admin/daftarulang') }}" class="text-decoration-none">

                    <div class="card border-left-secondary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                        Data Keseluruhan Daftar Ulang</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalDaftarUlang }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-list-alt fa-2x text-gray-300"></i>

                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ url('/admin/daftarulang?status=acc') }}" data-status="acc" class="text-decoration-none filter-link">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Daftar Ulang ACC</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $accberkas }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-thumbs-up fa-2x text-gray-300"></i>

                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ url('/admin/daftarulang?status=menunggu') }}" data-status="acc" class="text-decoration-none filter-link">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Data Daftar Ulang Menunggu</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $berkasmenunggu }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clock fa-2x text-gray-300"></i>

                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>


        <h5 class="mb-3 mt-2 h5 text-gray-800  text-xs-center text-black">Widget Jadwal PPDB</h5>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ url('/admin/informasi/1') }}" class="text-decoration-none">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Periode Pendaftaran</div>
                                    <div class=" mb-0 font-weight-bold text-gray-800">{{ $informasiPendaftaran->tanggal_mulai->format('d M Y') }} - {{ $informasiPendaftaran->tanggal_selesai->format('d M Y') }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>

                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ url('/admin/informasi/2') }}" class="text-decoration-none">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Tanggal Pengumuman Lolos</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $informasiPengumuman->tanggal_pengumuman->format('d M Y') }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-bullhorn fa-2x text-gray-300"></i>

                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{url('/admin/informasi/3') }}" class="text-decoration-none">
                    <div class="card border-left-dark shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                        Tanggal Daftar Ulang Berkas</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $informasiDaftarUlang->tanggal_daftar_ulang->format('d M Y') }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>

                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{ url('/admin/informasi/4') }}" class="text-decoration-none">
                    <div class="card border-left-dark shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                        Tanggal Siswa Masuk</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $informasiTanggalMasuk->tanggal->format('d M Y') }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file-alt fa-2x text-gray-300"></i>

                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>



        <!-- Content Row -->

    </div>
    <!-- container-fluid -->
    <!--
    @push('script')
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
    @endpush -->



</x-app-layout>
