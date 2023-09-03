<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>PPDB - SDN 1 Kretek</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    @include('frontend.template.linkstyle')


    <style>
        .icon-box {
            text-align: center;
        }

        .icon-box .icon {
            margin: 0 auto;
        }

        .icon-box .title a {
            margin-top: 15px;
            display: inline-block;
            padding: 10px 20px;
            border: 1px solid #333;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .icon-box .title a:hover {
            background-color: #333;
            color: #fff;
        }

        .card-title-enhanced {
            border-bottom: 2px solid #E5E5E5;
            /* Garis tipis di bawah judul */
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-weight: 700;

            /* Font bold */
            color: #333;



            display: inline-block;
            padding-bottom: 10px;
            /* Warna gelap */
        }

        .card {
            border: none;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-10px);
            /* Efek hover untuk mengangkat card sedikit */
        }

        .card-info-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .card-info-item i {
            margin-right: 8px;
            color: #6C757D;
            /* Warna ikon abu-abu */
        }

        .body {
            font-family: 'Lato', sans-serif;
        }

        .card-info-item i.fas {
            margin-right: 8px;
            /* Atur sesuai kebutuhan */
        }
    </style>

</head>



<body>
    <!--=======Top Bar=======-->
    <div id="topbar" class="fixed-top d-flex align-items-center ">
        <div class="container d-flex align-items-center justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope-fill"></i><a href="mailto:sdn1kretek@education.com">sdn1kretek@ppdb.com</a>
                <!-- <i class="bi bi-phone-fill phone-icon"></i> +62 8161 4646 4646 -->
            </div>
            <div class="cta d-none d-md-block">
                @if(Auth::check())
                <a href="/admin/dashboard" class="scrollto">Dashboard</a>
                @else
                <a href="/admin/dashboard" class="scrollto">Login Admin</a>
                @endif
            </div>

        </div>
    </div>

    <!-- ======= Header ======= -->
    @include('frontend.template.header')
    <!-- End Header -->

    <!-- ======= Hero Section ======= -->
    @include('frontend.template.herosection')
    <!-- End Hero -->

    <main id="main">
        <!-- ======= Icon Boxes Section ======= -->
        <section id="icon-boxes" class="icon-boxes">
            <div class="container">

                <div class="row">
                    <!-- Existing Icons Here -->

                    <!-- Form Pendaftaran -->
                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="400">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-edit"></i></div> <!-- You can replace the icon as needed -->
                            <h4 class="title"><a href="/pendaftaran">Form Pendaftaran</a></h4>
                            <p class="description">Daftarkan diri Anda melalui form pendaftaran online.</p>
                        </div>
                    </div>

                    <!-- Pengumuman -->
                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="500">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-megaphone"></i></div>
                            <h4 class="title"><a href="/pengumuman">Pengumuman</a></h4>
                            <p class="description">Lihat pengumuman terkait proses penerimaan siswa baru.</p>
                        </div>
                    </div>

                    <!-- Daftar Ulang -->
                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="600">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-arrow-repeat"></i></div>
                            <h4 class="title"><a href="/daftarulang">Daftar Ulang</a></h4>
                            <p class="description">Lakukan daftar ulang untuk kirim berkas pendaftaran.</p>
                        </div>
                    </div>

                    <!-- Cek Hasil Informasi Data Input -->
                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="700">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-info-circle"></i></div>
                            <h4 class="title"><a href="/hasil-pendaftaran">Cek Data Siswa</a></h4>
                            <p class="description">Periksa data yang telah Anda input dalam formulir pendaftaran.</p>
                        </div>
                    </div>

                </div>

            </div>
        </section>
        <!-- End Icon Boxes Section -->

        <!-- ======= About Us Section ======= -->
        <section id="about" class="about">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2> <strong><strong>Tentang SDN 1 Kretek</strong></strong></h2>
                    <p>SD Negeri 1 Kretek merupakan salah satu sekolah dasar milik pemerintah dengan tingkat terbaik yang berada di kecamatan Kretek, Bantul Yogyakarta. sekolah dasar ini sudah memiliki akreditasi A dan memiliki peran yang penting dalam melakukan penaikan kualitas pendidikan.
                        SD Negeri 1 Kretek merupakan sekolah yang sudah berdiri sejak tahun 1926 dan setiap tahun ajaran selalu memiliki peningkatan akademik menjadi lebih baik.
                    </p>
                    <br>
                    <!-- <h3>Visi & Misi</h3> -->
                </div>
                <!-- <div class="row content">
                    <div class="col-12 text-center">
                        <h3>Visi :</h3>
                        <ul>

                            <li><span class="bi bi-caret-right"></span> Terwujudnya peserta didik yang bertaqwa, berprestasi, sehat, dan berkarakter bangsa.
                        </ul>

                    </div>
                    <div class="col-12 text-center mt-2">
                        <h3>Misi :</h3>
                        <ul>

                            <li><span class="bi bi-caret-right"></span> Meningkatkan iman dan taqwa melalui penghayatan dan pengamalan ajaran agama.</li>
                            <li><span class="bi bi-caret-right"></span> Menyelenggarakan kegiatan pembelajaran yang berkualitas dan menyenangkan.</li>
                            <li><span class="bi bi-caret-right"></span> Menyelenggarakan kegiatan ekstrakurikuler sesuai bakat, minat dan kemampuan siswa.</li>
                            <li><span class="bi bi-caret-right"></span> Menciptakan lingkungan belajar dan lingkungan sekolah yang kondusif bagi warga sekolah.</li>
                            <li><span class="bi bi-caret-right"></span> Menumbuhkan budi pekerti luhur melalui pengamalan ajaran agama dan kearifan budaya.</li>
                        </ul>

                    </div>
                </div> -->
            </div>
        </section><!-- End About Us Section -->

        <!-- jadwal -->
        @include('frontend.template.jadwal')

        <!-- ======= Services Section ======= -->
        <section id="panduan" class="services">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Panduan</h2>
                    <p>Penerimaan Peserta Didik Baru Sekolah Dasar Negeri 1 Kretek membuka kesempatan seluas–luasnya bagi penduduk usia sekolah agar memperoleh
                        layanan pendidikan yang sebaik–baiknya secara : Objektif, Transparan dan, Akuntabel sesuai pedoman peraturan mentri pendidikan dan
                        kebudayaan Nomor 1 Tahun 2021 tentang penerimaan peserta didik baru pada sekolah dasar.
                    </p>
                    <h6 class="mt-3">Berikut panduan pendaftaran siswa baru:</h6>
                </div>

                <div class="row">
                    <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                        <div class="icon-box">
                            <i class="bi bi-pin-map"></i>
                            <h4><a href="#">Zonasi</a></h4>
                            <p>Pendaftaran Penerimaan Peserta Didik Baru di prioritaskan kepada siswa dalam zonasi atau daerah sekitar sekolah. Sistem Zonasi ditetapkan dengan alamat tempat tinggal Calon Peserta Didik Baru yang dibuktikan dengan dokumen kependudukan Calon Peserta Didik Baru. </p>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="200">
                        <div class="icon-box">
                            <i class="bi bi-person-exclamation"></i>
                            <h4><a href="">Minimum Berusia 7 Tahun</a></h4>
                            <p>Dalam proses seleksi Penerimaan Peserta Didik Baru jenjang Sekolah Dasar Negeri, tidak diperbolehkan diadakan tes yang bersifat akademis (membaca, menulis, berhitung) dan hanya berdasarkan usia calon peserta didik</p>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="300">
                        <div class="icon-box">
                            <i class="bi bi-pencil"></i>
                            <h4><a href="#">Pengisian Formulir</a></h4>
                            <p>Wali Siswa mengisi formulir pendaftaran melalui <a href="/pendaftaran" style="color: blue; font-style: italic;">link ini</a> isi sesuai dengan data yang di minta.</p>
                        </div>
                    </div>

                    <div class="col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="400">
                        <div class="icon-box">
                            <i class="bi bi-megaphone"></i>

                            <h4><a href="#">Pengumuman Kelulusan</a></h4>
                            <p>Pengumuman kelulusan. Wali Siswa atau Calon siswa setelah mengisi form dapat melihat hasil data dengan mengunjungi <a href="/" style="color: blue; font-style: italic;">link ini</a>.</p>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="500">
                        <div class="icon-box">
                            <i class="bi bi-calendar4-week"></i>
                            <h4><a href="#">Daftar Ulang</a></h4>
                            <p>Wali Siswa melakukan daftar ulang dengan mengirim berkas berupa akta kelahiran & kartu keluarga pada <a href="/" style="color: blue; font-style: italic;">link ini</a>.</p>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="600">
                        <div class="icon-box">
                            <i class="bi bi-info-square"></i>
                            <h4><a href="#">Ketentuan Tambahan</a></h4>
                            <p>Apabila terdapat perbedaan pada hasil bukti cetak/print out pendaftaran Calon Peserta Didik Baru dengan data pada sistem Penerimaan Peserta Didik Baru Online, maka data yang dinyatakan valid dan yang digunakan adalah data terbaru sesuai dengan update data terbaru pada sistem</p>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- End Services Section -->

        <!-- ======= Help Section ======= -->
        <section id="cta" class="cta">
            <div class="container">

                <div class="row" data-aos="zoom-in">
                    <div class="col-lg-9 text-center text-lg-start">
                        <h3>Butuh Bantuan ?</h3>
                        <p> Silahkan hubungi kami melalui email.</p>
                    </div>
                    <div class="col-lg-3 cta-btn-container text-center">
                        <a class="cta-btn align-middle" href="#">Hubungi Sekarang!</a>
                    </div>
                </div>

            </div>
        </section><!-- End Cta Section -->

        <!-- ======= Frequently Asked Questions Section ======= -->
        <section id="faq" class="faq section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Pertanyaan yang Sering Diajukan</h2>
                </div>

                <div class="faq-list">
                    <ul>
                        <li data-aos="fade-up" data-aos-delay="100">
                            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-1" class="collapsed">Apa itu sistem zonasi dalam PPDB dan bagaimana cara kerjanya? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                            <div id="faq-list-1" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    Sistem zonasi dalam PPDB adalah sistem yang mengutamakan penerimaan siswa berdasarkan kedekatan rumah siswa dengan sekolah. Tujuannya adalah untuk meminimalkan biaya transportasi dan memastikan siswa dapat bersekolah di area terdekat dari tempat tinggalnya.
                                </p>
                            </div>
                        </li>

                        <li data-aos="fade-up" data-aos-delay="200">
                            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-2" class="collapsed">Bagaimana cara menghitung zonasi untuk PPDB? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                            <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    Zonasi untuk PPDB biasanya dihitung berdasarkan radius jarak antara rumah siswa dengan sekolah. Setiap sekolah atau daerah mungkin memiliki ketentuan radius yang berbeda-beda. Pastikan untuk memeriksa informasi dari sekolah atau dinas pendidikan setempat.
                                </p>
                            </div>
                        </li>

                        <li data-aos="fade-up" data-aos-delay="300">
                            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-3" class="collapsed">Apakah ada batas usia minimum atau maksimum untuk mendaftar melalui PPDB? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                            <div id="faq-list-3" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    Ya, ada batas usia yang ditentukan oleh sekolah atau dinas pendidikan setempat. Yaitu minimum 7 tahun dan maksimal 12 tahun.
                                </p>
                            </div>
                        </li>

                        <li data-aos="fade-up" data-aos-delay="400">
                            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-4" class="collapsed">Apakah saya dapat mendaftar di sekolah lain jika berada di luar zonasi? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                            <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    Meskipun sistem zonasi mengutamakan penerimaan siswa dari area terdekat, beberapa sekolah mungkin memiliki kuota khusus untuk siswa dari luar zonasi. Anda harus memeriksa kebijakan dan ketentuan masing-masing sekolah untuk mengetahui detailnya.
                                </p>
                            </div>
                        </li>

                        <li data-aos="fade-up" data-aos-delay="500">
                            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-5" class="collapsed">Bagaimana jika saya pindah rumah setelah mendaftar? Apakah zonasi saya berubah? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                            <div id="faq-list-5" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    Jika Anda pindah rumah setelah mendaftar, Anda harus segera menginformasikan kepada sekolah dan menyertakan bukti alamat baru. Kebijakan mengenai perubahan zonasi karena pindah rumah mungkin berbeda di setiap sekolah, jadi pastikan untuk berkonsultasi dengan pihak sekolah.
                                </p>
                            </div>
                        </li>


                    </ul>
                </div>

            </div>
        </section><!-- End Frequently Asked Questions Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Kontak Person</h2>
                </div>

                <div class="row mt-1 justify-content-center" data-aos="fade-right" data-aos-delay="100">

                    <div class="col-lg-8">
                        <div class="info">
                            <div class="address">
                                <i class="bi bi-geo-alt"></i>
                                <h4>Location:</h4>
                                <p>Tegalsari, Donotirto, Kec. Kretek, Kabupaten Bantul, Daerah Istimewa Yogyakarta 55772</p>
                            </div>

                            <div class="email">
                                <i class="bi bi-envelope"></i>
                                <h4>Email:</h4>
                                <p>sdn1kretek@ppdb.com</p>
                            </div>


                        </div>
                    </div>

                </div>

            </div>
        </section>


    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('frontend.template.footer')
    <!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    @include('frontend.template.script')

</body>

</html>
