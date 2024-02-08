<x-app-layout title='Tambah Jadwal'>
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
        <h2 class="mb-2 h3 text-gray-800  text-xs-center text-black">Tambah Infromasi Jadwal</h2>
        <p class="mb-4">Halaman untuk tambah data Jadwal.</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Data Infromasi Jadwal</h6>
            </div>

            @if(session('success'))
            alert("{{ session('success') }}");
            @endif

            <div class="card-body">
                <form action="{{ route('informasi.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-8 form-group">
                            <label for="kegiatan" class="required">Informasi Kegiatan</label>
                            <input type="text" class="form-control" name="kegiatan" placeholder="Nama Kegiatan">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="jenis" class="required">Jenis Informasi</label>
                            <select class="form-control" name="jenis" id="jenis">
                                <option value="" disabled selected>Pilih Jenis</option>
                                <option value="pendaftaran">Pendaftaran_</option>
                                <option value="pengumuman">Pengumuman_</option>
                                <option value="daftarulang">Daftar Ulang_</option>
                                <option value="siswamasuk">Siswa Masuk_</option>
                                <option value="lainya">Lainya</option>
                            </select>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group mt-3 mt-md-0">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" rows="3" id="deskripsi" placeholder="Deskripsi Kegiatan"></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="tanggal_mulai">Tanggal Mulai</label>
                            <input type="date" class="form-control" name="tanggal_mulai">
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <label for="tanggal_selesai">Tanggal Selesai</label>
                            <input type="date" class="form-control" name="tanggal_selesai">
                        </div>
                    </div>


                    <a href="{{ route('informasi.index.admin') }}" class="btn btn-secondary custom-btn">Kembali</a>
                    <button type="submit" class="btn btn-primary custom-btn">Simpan</button>
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
