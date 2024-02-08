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

        .required::after {
            content: " *";
            color: red;
        }
    </style>
    <!-- main content -->
    <div class="container-fluid c-black position-relative">

        <!-- Page Heading -->
        <h2 class="mb-2 h3 text-gray-800  text-xs-center text-black">Edit Profil</h2>
        <p class="mb-4">Halaman edit Profil.</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Profil</h6>
            </div>
            <div class="card-body">
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
                @endif
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('put')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama" class="required">{{ __('Nama') }}</label>
                                <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', Auth::user()->nama) }}" required autofocus>
                                @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username" class="required">{{ __('Username') }}</label>
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username', Auth::user()->username) }}" required>
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">{{ __('Password Baru') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password baru">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation">{{ __('Konfirmasi Password Baru') }}</label>
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password baru">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 d-flex justify-content-end">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary custom-btn mr-2">Kembali</a>
                            <button type="submit" class="btn btn-primary">{{ __('Update Profil') }}</button>
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
