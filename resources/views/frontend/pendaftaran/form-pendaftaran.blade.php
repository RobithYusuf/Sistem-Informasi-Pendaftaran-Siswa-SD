@extends('frontend.index-form')
@section('judul','Form Pendaftaran')
@section('link_judul_halaman1','/pendaftaran')
@section('nama_link_judul_halaman1','Form Pendaftaran')

@section('content')

<style>
    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #333;
    }

    .required-star {
        color: red;
    }

    .label {
        font-weight: bold;
        text-align: right;
    }

    .modal-body {
        font-size: 15px;
    }

    .row {
        line-height: 2;
    }

    .icon-spacing {
        margin-right: 1rem;
    }

    .icon-orange {
        color: #f8c255;
    }
</style>

<section id="pendaftaran" class="contact bg-light py-5">
    <div class="container" data-aos="fade-up">
        <div class="section-title text-center">
            <h2>Formulir Pendaftaran Siswa Baru</h2>
            <p>Mohon isi formulir berikut dengan informasi yang valid dan akurat.</p>
        </div>
        <div class="row mt-4 d-flex justify-content-center" data-aos="fade-right" data-aos-delay="100">
            <div class="col-lg-10 mx-auto mt-5 mt-lg-0" data-aos="fade-left" data-aos-delay="100">

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if(session('success'))
                alert("{{ session('success') }}");
                @endif

                <form action="{{ route('pendaftaran.store') }}" method="post" role="form" class="php-email-form">
                    @csrf
                    <!-- Personal Information -->
                    <h4 class="mb-4">Informasi Pribadi Siswa :</h4>
                    @include('frontend.pendaftaran.form.data-siswa')

                    <!-- Guardian Information -->
                    <h4 class="mt-5 mb-4">Informasi Wali :</h4>
                    @include('frontend.pendaftaran.form.data-wali')

                    <div class="my-3">
                        <div class="loading">Loading</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Pendaftaran Anda telah terkirim. Terima kasih!</div>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" class="btn btn-primary submit-button" id="showConfirmationButton">Kirim Pendaftaran</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

</section>

@if(session('success'))
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="successModalLabel">Pendaftaran Berhasil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{ session('success') }}</p>
            </div>
            <div class="modal-footer">
                <a href="{{ route('pendaftaran.hasil') }}" class="btn btn-primary">Cek Hasil Pendaftaran</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>

        </div>
    </div>
</div>
@endif


<script>
    @if(session('success'))
    $(document).ready(function() {
        $('#successModal').modal('show');
    });
    @endif
</script>

<!-- Modal -->
<div class="modal fade" id="showConfirmationModal" tabindex="-1" aria-labelledby="showConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- tambahkan kelas modal-lg -->

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showConfirmationModalLabel">
                    <i class="bi bi-exclamation-square icon-spacing icon-orange"></i>Konfirmasi Pengisian Data
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-4 label">NIK :</div>
                    <div class="col-8"><span id="modalNik">-</span></div>
                    <div class="col-4 label">Nama :</div>
                    <div class="col-8"><span id="modalNama">-</span></div>
                    <div class="col-4 label">Agama :</div>
                    <div class="col-8"><span id="modalAgama">-</span></div>
                    <div class="col-4 label">Jenis Kelamin :</div>
                    <div class="col-8"><span id="modalJenisKelamin">-</span></div>
                    <div class="col-4 label">Tempat Lahir :</div>
                    <div class="col-8"><span id="modalTempatLahir">-</span></div>
                    <div class="col-4 label">Tanggal Lahir :</div>
                    <div class="col-8"><span id="modalTanggalLahir">-</span></div>
                    <div class="col-4 label">Jumlah Saudara :</div>
                    <div class="col-8"><span id="modalJumlahSaudara">-</span></div>
                    <div class="col-4 label">Anak Ke :</div>
                    <div class="col-8"><span id="modalAnakKe">-</span></div>
                    <div class="col-4 label">Alamat :</div>
                    <div class="col-8"><span id="modalAlamat">-</span></div>
                    <div class="col-4 label">Nama Wali :</div>
                    <div class="col-8"><span id="modalNamaWali">-</span></div>
                    <div class="col-4 label">Pekerjaan Wali :</div>
                    <div class="col-8"><span id="modalPekerjaanWali">-</span></div>
                    <div class="col-4 label">Email Wali :</div>
                    <div class="col-8"><span id="modalEmailWali">-</span></div>
                    <div class="col-4 label">No HP Wali :</div>
                    <div class="col-8"><span id="modalNoHp">-</span></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Periksa Kembali</button>
                <button type="button" class="btn btn-primary">Ya Sesuai, Lanjut Kirim</button>
            </div>
        </div>
    </div>
</div>


<script>
    // Fungsi untuk mengecek apakah semua field wajib terisi
    function isFormValid(form) {
        return form.checkValidity(); // contoh sederhana
    }
    // Ketika tombol "Kirim Pendaftaran" diklik, tampilkan modal jika form valid
    document.getElementById('showConfirmationButton').addEventListener('click', function(e) {
        var form = document.querySelector('form');

        if (isFormValid(form)) {
            // Ambil data dari form
            // Ambil data dari form
            var form = document.querySelector('form');
            var nik = form.querySelector('[name="nik"]').value;
            var nama = form.querySelector('[name="nama"]').value;
            var agama = form.querySelector('[name="agama"]').value; // Ini adalah elemen select
            var jenis_kelamin = form.querySelector('[name="jenis_kelamin"]').value; // Ini adalah elemen select
            var tempat_lahir = form.querySelector('[name="tempat_lahir"]').value;
            var tanggal_lahir = form.querySelector('[name="tanggal_lahir"]').value;
            var jumlah_saudara = form.querySelector('[name="jumlah_saudara"]').value;
            var anak_ke = form.querySelector('[name="anak_ke"]').value;
            var alamat = form.querySelector('[name="alamat"]').value;
            var nama_wali = form.querySelector('[name="nama_wali"]').value; // Ini adalah elemen textarea
            var pekerjaan_wali = form.querySelector('[name="pekerjaan_wali"]').value; // Ini adalah elemen textarea
            var email = form.querySelector('[name="email"]').value; // Ini adalah elemen textarea
            var no_hp = form.querySelector('[name="no_hp"]').value; // Ini adalah elemen textarea


            // Tampilkan dalam modal
            document.getElementById('modalNik').innerHTML = nik || '<em>Null</em>';
            document.getElementById('modalNama').innerHTML = nama || '<em>Null</em>';
            document.getElementById('modalAgama').innerHTML = agama || '<em>Null</em>';
            document.getElementById('modalJenisKelamin').innerHTML = jenis_kelamin || '<em>Null</em>';
            document.getElementById('modalTempatLahir').innerHTML = tempat_lahir || '<em>Null</em>';
            document.getElementById('modalTanggalLahir').innerHTML = tanggal_lahir || '<em>Null</em>';
            document.getElementById('modalJumlahSaudara').innerHTML = jumlah_saudara || '<em>Null</em>';
            document.getElementById('modalAnakKe').innerHTML = anak_ke || '<em>Null</em>';
            document.getElementById('modalAlamat').innerHTML = alamat || '<em>Null</em>';
            document.getElementById('modalNamaWali').innerHTML = nama_wali || '<em>Null</em>';
            document.getElementById('modalPekerjaanWali').innerHTML = pekerjaan_wali || '<em>Null</em>';
            document.getElementById('modalEmailWali').innerHTML = email || '<em>Null</em>';
            document.getElementById('modalNoHp').innerHTML = no_hp || '<em>Null</em>';



            // Tampilkan modal
            var modal = new bootstrap.Modal(document.getElementById('showConfirmationModal'));
            modal.show();
        } else {
            form.reportValidity(); // Menunjukkan pesan bawaan browser untuk field yang tidak valid
        }
    });

    // Ketika tombol "Ya Sesuai, Lanjut Kirim" diklik, kirim form
    document.querySelector('#showConfirmationModal .btn-primary').addEventListener('click', function() {
        document.querySelector('form').submit();
    });
</script>


@endsection
