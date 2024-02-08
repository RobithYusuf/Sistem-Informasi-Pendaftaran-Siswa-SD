<x-app-layout title='Edit Jadwal'>
    <style>
        .custom-btn {
            width: 100px;
            height: 40px;
            line-height: 40px;
            padding: 0 12px;
            margin: 0;
            display: inline-block;
            vertical-align: middle;
        }

        .required::after {
            content: " *";
            color: red;
        }
    </style>
    <!-- main content -->
    <div class="container-fluid c-black position-relative">

        <!-- Page Heading -->
        <h2 class="mb-2 h3 text-gray-800  text-xs-center text-black">Edit Jadwal Informasi</h2>
        <p class="mb-4">Halaman untuk edit data (landing page).</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Data Jadwal</h6>
            </div>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <div class="card-body">
                <form action="{{ route('informasi.update', $data->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="kegiatan" class="required">Judul Informasi Kegiatan</label>
                                <input type="text" class="form-control" id="kegiatan" value="{{ $data->kegiatan }}" name="kegiatan">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="jenis" class="required">Jenis Informasi</label>
                                <select class="form-control" name="jenis" id="jenis">
                                    <option value="" disabled {{ old('jenis', $data->jenis) ? '' : 'selected' }}>Pilih Jenis</option>
                                    <option value="pendaftaran" {{ old('jenis', $data->jenis) == 'pendaftaran' ? 'selected' : '' }}>Pendaftaran</option>
                                    <option value="pengumuman" {{ old('jenis', $data->jenis) == 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                                    <option value="daftarulang" {{ old('jenis', $data->jenis) == 'daftarulang' ? 'selected' : '' }}>Daftar Ulang</option>
                                    <option value="siswamasuk" {{ old('jenis', $data->jenis) == 'siswamasuk' ? 'selected' : '' }}>Siswa Masuk</option>
                                    <option value="lainya" {{ old('jenis', $data->jenis) == 'lainya' ? 'selected' : '' }}>Lainya</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi Detail</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi">{{ $data->deskripsi }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_mulai">Tanggal Mulai</label>
                                <input type="date" class="form-control" id="tanggal_mulai" value="{{ $data->tanggal_mulai ? $data->tanggal_mulai->format('Y-m-d') : '' }}" name="tanggal_mulai">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_selesai">Tanggal Selesai</label>
                                <input type="date" class="form-control" id="tanggal_selesai" value="{{ $data->tanggal_selesai ? $data->tanggal_selesai->format('Y-m-d') : '' }}" name="tanggal_selesai">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-end">
                            <a href="{{ route('informasi.index.admin') }}" class="btn btn-secondary custom-btn mr-2">Kembali</a>
                            <button type="submit" class="btn btn-primary custom-btn">Simpan</button>
                        </div>
                    </div>

                </form>



            </div>


        </div>
    </div>

    @push('script')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    @endpush

</x-app-layout>
