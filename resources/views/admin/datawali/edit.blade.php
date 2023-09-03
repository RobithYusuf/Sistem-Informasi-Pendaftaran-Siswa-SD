<x-app-layout title='Edit Wali'>
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
        <p class="mb-4">Halaman untuk edit data Wali.</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Data Wali</h6>
            </div>
            <div class="card-body">
                <form action="{{route('datawali.update', ['pendaftaran' => $pendaftaran->id])}}" method="POST">
                    @method('PUT')
                    @csrf

                    <div class="row">
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <label>Nama Wali</label>
                            <input type="text" class="form-control" value="{{$pendaftaran->nama_wali}}" name="nama_wali">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Pekerjaan Wali</label>
                            <input type="text" class="form-control" value="{{$pendaftaran->pekerjaan_wali}}" name="pekerjaan_wali">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" value="{{$pendaftaran->email}}" name="email">
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <label>No Hp</label>
                            <input type="text" class="form-control" value="{{$pendaftaran->no_hp}}" name="no_hp">
                        </div>
                    </div>
                    <a href="{{route('datawali.index')}}" class="btn btn-secondary custom-btn">Kembali</a>
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
