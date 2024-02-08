<x-app-layout title='Edit Pengumuman'>
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
        <h2 class="mb-2 h3 text-gray-800  text-xs-center text-black">Edit Pengumuman</h2>
        <p class="mb-4">Halaman untuk edit data Pengumuman.</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Data Pengumuman</h6>
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

                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <form action="{{ route('pengumuman.update', ['pengumuman' => $pengumuman->id])}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Judul Pengumuman</label>
                            <input type="text" class="form-control" value="{{$pengumuman->judul_pengumuman}}" name="judul_pengumuman">
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <label>Tanggal Pengumuman</label>
                            <?php
                            $tanggalPengumuman = \Carbon\Carbon::parse($pengumuman->tanggal_pengumuman)->format('Y-m-d\TH:i');
                            ?>
                            <input type="datetime-local" class="form-control" value="{{ $tanggalPengumuman }}" name="tanggal_pengumuman">
                        </div>

                    </div>
                    <div class="form-group mt-3">
                        <label for="keterangan" class="form-label">Detail Isi Pengumuman</label>
                        <textarea class="form-control" name="keterangan" rows="25" id="keterangan">{{ old('keterangan', $pengumuman->keterangan ?? '') }}</textarea>
                    </div>


                    <a href="{{route('pengumuman.index.admin')}}" class="btn btn-secondary custom-btn">Kembali</a>
                    <button type="submit" class="btn btn-primary custom-btn">Save</button>
                </form>
            </div>


        </div>
    </div>
    <script src="https://cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('keterangan', {

            width: '100%', // Lebar CKEditor
            height: 450, // Tinggi CKEditor dalam piksel


        });
    </script>
    @push('script')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    @endpush

</x-app-layout>
