<x-app-layout title='Edit Pendaftaran'>
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
    </style>
    <!-- main content -->
    <div class="container-fluid c-black position-relative">

        <!-- Page Heading -->
        <h2 class="mb-2 h3 text-gray-800  text-xs-center text-black">Edit Pendaftaran</h2>
        <p class="mb-4">Halaman untuk edit data Pendaftaran.</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Data Pendaftaran</h6>
            </div>
            <div class="card-body">
                <form action="{{route('pendaftaran.update', ['pendaftaran' => $pendaftaran->id])}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>NIK</label>
                            <input type="text" class="form-control" value="{{$pendaftaran->nik}}" name="nik">
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <label>Nama Siswa</label>
                            <input type="text" class="form-control" value="{{$pendaftaran->nama}}" name="nama">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control" id="jenis_kelamin">
                                <option value="Laki-laki" {{ old('jenis_kelamin', $pendaftaran->jenis_kelamin) === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $pendaftaran->jenis_kelamin) === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <label>Agama</label>
                            <select name="agama" class="form-control" id="agama">
                                <option value="Islam" {{ old('agama', $pendaftaran->agama) === 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ old('agama', $pendaftaran->agama) === 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ old('agama', $pendaftaran->agama) === 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ old('agama', $pendaftaran->agama) === 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ old('agama', $pendaftaran->agama) === 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Konghucu" {{ old('agama', $pendaftaran->agama) === 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Tempat Lahir</label>
                            <input type="text" class="form-control" value="{{$pendaftaran->tempat_lahir}}" name="tempat_lahir">
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <label>Tanggal Lahir</label>
                            <input type="date" class="form-control" value="{{$pendaftaran->tanggal_lahir}}" name="tanggal_lahir">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" value="{{$pendaftaran->alamat}}" name="alamat">
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <label>Jumlah Saudara</label>
                            <input type="text" class="form-control" value="{{$pendaftaran->jumlah_saudara}}" name="jumlah_saudara">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Anak Ke-</label>
                            <input type="text" class="form-control" value="{{$pendaftaran->anak_ke}}" name="anak_ke">
                        </div>

                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <label>Tanggal Pendaftaran</label>
                            <input type="text" class="form-control" value="{{$pendaftaran->created_at}}" name="created_at">
                        </div>
                    </div>
                    <a href="{{route('pendaftaran.index')}}" class="btn btn-secondary custom-btn">Kembali</a>
                    <button type="submit" class="btn btn-primary custom-btn">Save</button>
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