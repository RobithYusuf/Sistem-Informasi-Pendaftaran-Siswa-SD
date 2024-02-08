<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('judul')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <base href="http://ppdb-online.test/">
    @include('frontend.template.linkstyle')
    
</head>

<style>
    .navbar li.active>a:before {
        visibility: visible;
        width: 100%;
    }

    .special-character {
        color: #f8c255;
    }

    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        margin: 0;
    }

    main {
        flex: 1;
    }

    footer {
        flex-shrink: 0;
    }
</style>

<body>
    <div id="topbar" class="fixed-top d-flex align-items-center topbar-inner-pages">
        <div class="container d-flex align-items-center justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope-fill"></i><a href="mailto:sdn1kretek@education.com">sdn1kretek@ppdb.com</a>
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
    <header id="header" class="fixed-top d-flex align-items-center header-inner-pages">
        <div class="container d-flex align-items-center justify-content-between">
            <div class="row align-items-center">
                <div class="col-auto">
                    <a href="/" class="logo"><img src="{{asset('assets/img/logo.png')}}" alt="logo" class="img-fluid"></a>
                </div>
                <div class="col-auto">
                    <h1 class="logo d-none d-md-block"><a href="/">SD Negeri 1 Kretek</a></h1>
                    <h1 class="logo d-md-none"><a href="/">SDN 1 Kretek</a></h1>

                </div>
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto @if(!Request::is('pendaftaran*')) active @endif" href="/#hero">Home</a></li>
                    <li class="dropdown @if(Request::is('pendaftaran*')) active @endif">
                        <a href="#"><span>Pendaftaran</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="/pendaftaran">Pengisian Formulir</a></li>
                            <li><a href="/pengumuman">Pengumuman</a></li>
                            <li><a href="/daftarulang">Daftar Ulang</a></li>
                        </ul>
                    </li>
                    <li><a class="nav-link scrollto @if(Request::is('hasil-pendaftaran*')) active @endif" href="/hasil-pendaftaran">Data Hasil Pendaftaran</a></li>
                    <li><a class="nav-link scrollto" href="/#panduan">Panduan</a></li>
                    <li><a class="nav-link scrollto" href="/#jadwal">Informasi Jadwal</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header>
    <!-- End Header -->

    <main id="main">
        <!-- ======= Breadcrumbs ======= -->

        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="/">Home</a></li>
                    <li><a href="@yield('link_judul_halaman1')"> @yield('nama_link_judul_halaman1')</a></li>
                </ol>
                <h2>@yield('judul_halaman')</h2>
            </div>
        </section>
        <!-- End Breadcrumbs -->

        @yield('content')

    </main>
    <!-- ======= Footer ======= -->
    @include('frontend.template.footer')
    <!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    @include('frontend.template.script')

</body>

</html>
