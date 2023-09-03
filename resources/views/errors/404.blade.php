<!DOCTYPE html>
<html lang="en">

<head>
    <title>PPDB | 404 Eror</title>
    <x-link />
    <style>
        .container-fluid {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- 404 Error Text -->
                    <!-- 404 Error Text -->
                    <div class="text-center">
                        <div class="error mx-auto" data-text="404">404</div>
                        <p class="lead text-gray-800 mb-5">Page Not Found</p>
                        <p class="text-gray-500 mb-0"> Halaman yang anda cari tidak ditemukan !</p>
                        <a href="{{ $returnUrl }}">&larr; Kembali ke Home Page</a>
                    </div>


                </div>

            </div>

            <x-footer />
        </div>

    </div>
</body>

</html>