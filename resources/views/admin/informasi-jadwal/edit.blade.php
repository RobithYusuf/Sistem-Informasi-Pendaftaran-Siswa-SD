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

            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <div class="card-body">
                <form action="{{route('informasi.update', $data->id)}}" method="POST">
                    @method('PUT')
                    @csrf

                    <div class="form-group">
                        <label>Judul Informasi</label>
                        <input type="text" class="form-control" value="{{$data->judul_informasi}}" name="judul_informasi">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Detail</label>
                        <textarea class="form-control" name="detail">{{ $data->detail }}</textarea>
                    </div>
                    @if($jenis == 'pendaftaran')
                    <div class="form-group">
                        <label>Tanggal Mulai Pendaftaran</label>
                        <input type="date" class="form-control" value="{{$data->tanggal_mulai->format('Y-m-d')}}" name="tanggal_mulai">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Selesai Pendaftaran</label>
                        <input type="date" class="form-control" value="{{$data->tanggal_selesai->format('Y-m-d')}}" name="tanggal_selesai">
                    </div>
                    @elseif($jenis == 'pengumuman')

                    <div class="form-group">
                        <label>Tanggal Pengumuman</label>
                        <input type="date" class="form-control" value="{{$data->tanggal_pengumuman->format('Y-m-d')}}" name="tanggal_pengumuman">
                    </div>
                    @elseif($jenis == 'daftar ulang')

                    <div class="form-group">
                        <label>Tanggal Daftar Ulang</label>
                        <input type="date" class="form-control" value="{{$data->tanggal_daftar_ulang->format('Y-m-d')}}" name="tanggal_daftar_ulang">
                    </div>
                    @elseif($jenis == 'informasi lain')

                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" class="form-control" value="{{$data->tanggal->format('Y-m-d')}}" name="tanggal">
                    </div>
                    @endif
                    <a href="{{route('informasi.index.admin')}}" class="btn btn-secondary custom-btn ">Kembali</a>
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