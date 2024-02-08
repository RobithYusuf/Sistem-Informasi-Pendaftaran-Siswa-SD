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
    $('.close').click(function() {
        $('#successModal').modal('hide');
    });
    @endif
</script>

<!-- Modal -->
<div class="modal fade" id="showConfirmationModal" tabindex="-1" aria-labelledby="showConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
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

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date();
        const minDate = new Date(today.getFullYear() - 12, today.getMonth(), today.getDate());
        const maxDate = new Date(today.getFullYear() - 6, today.getMonth(), today.getDate());

        flatpickr('#tanggal_lahir', {
            dateFormat: 'd-m-Y',
            defaultDate: new Date(today.getFullYear() - 9, today.getMonth(), today.getDate()), // Usia tengah antara 6-12 tahun
            disableMobile: true,
            locale: 'id',
            minDate: minDate,
            maxDate: maxDate,
            onChange: function(selectedDates, dateStr, instance) {
                validateField(instance.input);
            }
        });
    });

    document.querySelector('[name="nik"]').addEventListener('blur', function() {
        const nik = this.value;
        const errorDisplay = document.querySelector('#error-nik');

        if (nik.length === 16) {
            fetch('/cek-nik?nik=' + nik)
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        errorDisplay.textContent = 'NIK sudah terdaftar. Gunakan NIK lain.';
                        errorDisplay.style.display = 'block';
                    } else {
                        errorDisplay.style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    errorDisplay.textContent = 'Terjadi kesalahan saat memeriksa NIK.';
                    errorDisplay.style.display = 'block';
                });
        }
        console.log(error);
    });


    function isValidNik(nik) {
        if (!/^\d{16}$/.test(nik)) {
            return false;
        }

        if (/^(\d)\1+$/.test(nik)) {
            return false; // Jika NIK terdiri dari angka yang sama berulang-ulang
        }

        const tanggalLahir = nik.substring(6, 12);
        let tahun = parseInt(tanggalLahir.substring(4, 6), 10);
        const bulan = parseInt(tanggalLahir.substring(2, 4), 10) - 1;
        let tanggal = parseInt(tanggalLahir.substring(0, 2), 10);

        if (tanggal > 40) {
            tanggal -= 40; // Pengurangan untuk jenis kelamin perempuan
        }

        tahun += (tahun < 40 ? 2000 : 1900); // Asumsi untuk membedakan abad ke-20 dan ke-21
        const tanggalLahirValid = new Date(tahun, bulan, tanggal);

        if (tanggalLahirValid.getFullYear() !== tahun || tanggalLahirValid.getMonth() !== bulan || tanggalLahirValid.getDate() !== tanggal) {
            return false;
        }

        // Menghitung usia
        const hariIni = new Date();
        let usia = hariIni.getFullYear() - tanggalLahirValid.getFullYear();
        const m = hariIni.getMonth() - tanggalLahirValid.getMonth();
        if (m < 0 || (m === 0 && hariIni.getDate() < tanggalLahirValid.getDate())) {
            usia--;
        }

        // Memeriksa apakah usia berada dalam rentang 6 hingga 12 tahun
        if (usia < 6 || usia > 12) {
            return false;
        }

        return true;
    }


    function validateField(field) {
        let errorMessage = '';
        let value = field.value;
        let name = field.name;

        if (field.name === '_token') return true;
        if (name === 'nik') {
            if (!value) errorMessage = 'NIK wajib diisi!';
            else if (!/^\d{16}$/.test(value)) errorMessage = 'NIK harus terdiri dari 16 digit!';
            else if (/^0+$/.test(value)) errorMessage = 'NIK tidak valid';
            else if (!isValidNik(value)) errorMessage = 'NIK tidak valid';
        } else if (name === 'nama') {
            if (!value) errorMessage = 'Nama wajib diisi!';
            else if (value.length > 50) errorMessage = 'Nama tidak boleh lebih dari 50 karakter!';
            else if (!/^[a-zA-Z\s]*$/.test(value)) errorMessage = 'Nama hanya boleh mengandung huruf dan spasi!';
        } else if (name === 'jenis_kelamin' && !value) {
            errorMessage = 'Jenis kelamin wajib dipilih!';
        } else if (name === 'agama' && !value) {
            errorMessage = 'Agama wajib dipilih!';
        } else if (name === 'tempat_lahir') {
            if (!value) errorMessage = 'Tempat lahir wajib diisi';
            else if (value.length > 50) errorMessage = 'Tempat lahir tidak boleh lebih dari 50 karakter!';
            else if (!/^[a-zA-Z\s]*$/.test(value)) errorMessage = 'Tempat lahir hanya boleh mengandung huruf dan spasi!';
        } else if (name === 'email') {
            if (!value) errorMessage = 'Email wajib diisi';
            else if (!/\S+@\S+\.\S+/.test(value)) errorMessage = 'Format email tidak valid!';
            else if (value.length > 55) errorMessage = 'Email tidak boleh lebih dari 55 karakter!';
        }
        if (name === 'tanggal_lahir') {
            if (!value) {
                errorMessage = 'Tanggal lahir wajib diisi';
            } else {
                const parts = value.split('-');
                const birthDate = new Date(value);
                const today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
                const m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                if (age < 6 || age > 12) {
                    errorMessage = 'Usia pendaftar harus antara 6 hingga 12 tahun';
                }
            }
            // if (isNaN(new Date(value).getTime())) {
            //     errorMessage = 'Format tanggal lahir tidak valid!';
            // }
        } else if (name === 'jumlah_saudara') {
            if (!value) errorMessage = 'Jumlah saudara wajib diisi!';
            else if (isNaN(value) || value < 0) errorMessage = 'Jumlah saudara harus berupa angka positif!';
            else if (isNaN(value) || value >= 30) errorMessage = 'Data tidak valid';
        } else if (name === 'anak_ke') {
            if (!value) errorMessage = 'Anak ke- wajib diisi';
            else if (isNaN(value) || value < 0) errorMessage = 'Anak ke- harus berupa angka positif!';
            else if (isNaN(value) || value >= 30) errorMessage = 'Data tidak valid';
        } else if (name === 'alamat') {
            if (!value) errorMessage = 'Alamat wajib diisi!';
        } else if (name === 'nama_wali') {
            if (!value) errorMessage = 'Nama wali wajib diisi!';
            else if (!/^[a-zA-Z\s]*$/.test(value)) errorMessage = 'Nama hanya boleh mengandung huruf dan spasi!';
        } else if (name === 'email') {
            if (!value) errorMessage = 'Email wajib diisi';
            else if (!/\S+@\S+\.\S+/.test(value)) errorMessage = 'Format email tidak valid!';
            else if (value.length > 55) errorMessage = 'Email tidak boleh lebih dari 55 karakter!';
        } else if (name === 'no_hp') {
            if (!value) errorMessage = 'No HP wajib diisi!';
        } else if (name === 'pekerjaan_wali') {
            if (!value) errorMessage = 'Pekerjaan wali wajib diisi!';
            else if (!/^[a-zA-Z\s]*$/.test(value)) errorMessage = 'Nama hanya boleh mengandung huruf dan spasi!';
        }

        const errorDisplay = document.querySelector('#error-' + name);
        if (errorMessage) {
            errorDisplay.textContent = errorMessage;
            errorDisplay.style.display = 'block';
        } else {
            errorDisplay.style.display = 'none';
        }

        return !errorMessage;
    }


    document.querySelectorAll('input, select, textarea').forEach(field => {
        field.addEventListener('input', function() {
            validateField(field);
        });
    });

    document.getElementById('showConfirmationButton').addEventListener('click', function(e) {
        var form = document.querySelector('form');
        var isValid = true;

        form.querySelectorAll('input, select, textarea').forEach(field => {
            isValid = validateField(field) && isValid;
        });

        if (isValid) {
            var form = document.querySelector('form');
            var nik = form.querySelector('[name="nik"]').value;
            var nama = form.querySelector('[name="nama"]').value;
            var agama = form.querySelector('[name="agama"]').value;
            var jenis_kelamin = form.querySelector('[name="jenis_kelamin"]').value;
            var tempat_lahir = form.querySelector('[name="tempat_lahir"]').value;
            var tanggal_lahir = form.querySelector('[name="tanggal_lahir"]').value;
            var jumlah_saudara = form.querySelector('[name="jumlah_saudara"]').value;
            var anak_ke = form.querySelector('[name="anak_ke"]').value;
            var alamat = form.querySelector('[name="alamat"]').value;
            var nama_wali = form.querySelector('[name="nama_wali"]').value;
            var pekerjaan_wali = form.querySelector('[name="pekerjaan_wali"]').value;
            var email = form.querySelector('[name="email"]').value;
            var no_hp = form.querySelector('[name="no_hp"]').value;

            // Tampilan dalam modal
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
            // modal
            var modal = new bootstrap.Modal(document.getElementById('showConfirmationModal'));
            modal.show();
        } else {
            e.preventDefault();
        }
    });

    // Ketika tombol "Ya Sesuai, Lanjut Kirim" diklik, kirim form
    document.querySelector('#showConfirmationModal .btn-primary').addEventListener('click', function() {
        document.querySelector('form').submit();
    });
</script>
@endsection
