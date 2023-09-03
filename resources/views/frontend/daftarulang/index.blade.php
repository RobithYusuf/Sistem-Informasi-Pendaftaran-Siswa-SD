@extends('frontend.index-form')
@section('judul','Daftar Ulang')
@section('link_judul_halaman1','/daftarulang')
@section('nama_link_judul_halaman1','Daftar Ulang')
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

    .form-section {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        /* Allows the items to wrap as needed */
    }


    .instructions {
        width: 50%;
        padding: 20px;
        background: #f7f7f7;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .validation-form {
        width: 45%;
        margin-left: 2rem;
        margin-top: -20px !important;
    }

    .instructions,
    .validation-form {
        flex: 1;
        /* Allows the items to grow and take up equal space */
        min-width: 45%;
        /* Minimum width before wrapping */
        padding: 25px;
        box-sizing: border-box;
        /* Includes padding and border in element's total width and height */
    }

    @media screen and (max-width: 768px) {

        .instructions,
        .validation-form {
            min-width: 100%;
            /* Allows the items to stack vertically on small screens */
        }

        .validation-form {
            margin-left: 0;
            /* Mengatur margin-left menjadi 0 pada layar kecil */
            margin-top: 0 !important;
            /* Mengatur margin-top menjadi 0 pada layar kecil */
        }
    }


    .btn-primary {

        float: right;
        margin-top: 15px;
        background-color: #3498db;
        border: none;
        padding: 8px 20px;
        border-radius: 5px;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-primary.wider-button {
        margin-right: -1.2rem !important;
    }

    .wider-input {
        width: 104%;
        /* Contoh: menambahkan lebar menjadi 60% dari kontainernya */
    }

    #nik,
    #tanggal_lahir {
        width: 104%;
        /* Contoh: menambahkan lebar menjadi 60% dari kontainernya */
    }


    .btn-primary:hover {
        background-color: #2980b9;
    }

    .section-title {
        padding-bottom: 10px !important;
    }

    .hidden-form {
        display: none;
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    @keyframes fadeOut {
        0% {
            opacity: 1;
        }

        100% {
            opacity: 0;
        }
    }

    #notification {
        animation: fadeIn 0.5s ease;
    }
</style>

<section id="daftarulang" class="contact bg-light py-5">
    <div class="container" data-aos="fade-up">
        <div class="section-title text-center">
            <h2>Formulir Daftar Ulang</h2>
            <p>Mohon isi formulir berikut dengan informasi yang valid.</p>
        </div>
        @if(session('success'))
        <div id="notification" class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <h4 class="mt-5 mb-4">Validasi Wali Siswa :</h4>
        <div class="form-section mb-5">
            <!-- Petunjuk Validasi -->

            <div class="instructions">
                <h5>Petunjuk Validasi:</h5>
                <p>Masukkan NIK (16 Digit) dan tanggal lahir dalam format ddmmyyyy <strong>(contoh: 12082005)</strong> untuk memvalidasi identitas siswa.</p>
                <p>Setelah validasi berhasil, formulir upload dokumen Kartu Keluarga & Akte Kelahiran akan muncul di bawah.</p>
            </div>
            <!-- Form Input -->
            <form action="{{ route('validasidata') }}" method="post" role="form" id="validation-form" class="validation-form">
                @csrf
                <!-- NIK Input -->
                <div class="form-group">
                    <label for="nik" class="form-label">NIK Siswa <span class="required-star">*</span></label>
                    <input type="text" name="nik" id="nik" class="form-control wider-input mb-3" placeholder="Masukan NIK 16 digit" required>
                </div>
                <!-- Tanggal Lahir Input -->

                <div class="form-group">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir Siswa<span class="required-star">*</span></label>
                    <input type="text" name="tanggal_lahir" id="tanggal_lahir" class="form-control wider-input" placeholder="ddmmyyyy" required>
                </div>
                <button type="submit" class="btn btn-primary wider-button">Validasi Data</button>
            </form>
        </div>
        <div id="notification" class="alert alert-success" style="display: none;">
            Validasi berhasil, data siswa ditemukan. Silahkan mengupload berkas kartu keluarga dan akte kelahiran siswa!
        </div>

        <!-- formulir daftar ulang -->

        <div id="daftar-ulang-form" class="hidden-form mt-5">
            <form action="{{ route('kirimberkas') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="pendaftaran_id" id="pendaftaran_id">
                <!-- Data Siswa -->
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="nik" class="form-label">NIK Siswa</label>
                        <input type="text" id="nik_found" class="form-control" readonly disabled>
                    </div>
                    <div class="col-md-6 form-group mt-3 mt-md-0 mb-3">
                        <label for="nama" class="form-label">Nama Siswa</label>
                        <input type="text" id="nama_found" class="form-control" readonly disabled>
                    </div>
                </div>

                <!-- Upload Berkas -->
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="kartu_keluarga" class="form-label">Upload Kartu Keluarga <span class="required-star">*</span></label>
                        <input type="file" name="kartu_keluarga" class="form-control" required>
                    </div>
                    <div class="col-md-6 form-group mt-3 mt-md-0">
                        <label for="akta_kelahiran" class="form-label">Upload Akte Kelahiran<span class="required-star">*</span></label>
                        <input type="file" name="akta_kelahiran" class="form-control" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Kirim Berkas</button>
            </form>
        </div>

    </div>
</section>
<!-- nofikasi -->

<script>
    setTimeout(function() {
        $('#notification').fadeOut('fast');
    }, 10000); // 10 detik
</script>

<!-- validasi data dulu -->
<script>
    document.getElementById('validation-form').addEventListener('submit', function(e) {
        var nik = document.getElementById('nik').value;
        var tanggal_lahir = document.getElementById('tanggal_lahir').value;

        // Cek apakah NIK hanya berisi angka dan memiliki panjang 16 digit
        if (!/^\d{10,16}$/.test(nik)) {
            alert('Masukkan angka NIK dengan benar (16 angka)');
            e.preventDefault();
            return;
        }

        // Cek apakah tanggal lahir berformat ddmmyyyy
        if (!/^\d{2}\d{2}\d{4}$/.test(tanggal_lahir)) {
            alert('Masukkan tanggal lahir dengan format ddmmyyyy (contoh: 12082005)');
            e.preventDefault();
            return;
        }
    });
    // Contoh implementasi dengan AJAX
    document.getElementById('validation-form').addEventListener('submit', function(e) {
        e.preventDefault();
        // Dapatkan data dari form
        let formData = new FormData(this);
        // Kirim permintaan validasi ke server
        fetch("{{ route('validasidata') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const notificationElement = document.getElementById('notification');
                    notificationElement.style.display = 'block';

                    // Menambahkan timeout untuk menjalankan animasi fade-out dan menyembunyikan elemen
                    setTimeout(() => {
                        notificationElement.style.animation = 'fadeOut 0.5s ease';
                        notificationElement.style.opacity = 0;

                        // Menambahkan timeout lain untuk mengatur display:none setelah animasi fade-out selesai
                        setTimeout(() => {
                            notificationElement.style.display = 'none';
                            notificationElement.style.animation = ''; // Reset animasi
                            notificationElement.style.opacity = 1; // Reset opasitas
                        }, 500); // Durasi animasi fade-out

                    }, 5000);
                    document.getElementById('pendaftaran_id').value = data.pendaftaran_id;
                    document.getElementById('nik_found').value = data.nik;
                    document.getElementById('nama_found').value = data.nama;
                    document.getElementById('daftar-ulang-form').classList.remove('hidden-form');
                } else {
                    // Tampilkan pesan error
                    alert(data.error);
                }
            })
            .catch(error => console.error('Error:', error));
    });
</script>
@endsection