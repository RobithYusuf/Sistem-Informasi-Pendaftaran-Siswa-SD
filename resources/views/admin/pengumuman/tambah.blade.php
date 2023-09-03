<x-app-layout title='Tambah Pengumuman'>
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
        <h2 class="mb-2 h3 text-gray-800  text-xs-center text-black">Tambah Pengumuman</h2>
        <p class="mb-4">Halaman untuk tambah data Pengumuman.</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Data Pengumuman</h6>
            </div>

            @if(session('success'))
            alert("{{ session('success') }}");
            @endif

            <div class="card-body">
                <form action="{{ route('pengumuman.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="judul_pengumuman">Judul Pengumuan</label>
                            <input type="text" class="form-control" name="judul_pengumuman" placeholder="Judul Pengumuman">
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <label for="tanggal_pengumuman"> Tanggal Pengumuman</label>
                            <input type="datetime-local" class="form-control" name="tanggal_pengumuman">
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <label for="nama" class="form-label">Detail Isi Pengumuman</label>
                        <textarea class="form-control" name="keterangan" rows="10" id="keterangan" placeholder="Informasi Pengumuman"></textarea>
                    </div>
                    <a href="{{route('pengumuman.index.admin')}}" class="btn btn-secondary custom-btn">Kembali</a>
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
