<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>MyPortfolio Bootstrap Template - Index</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=https://fonts.googleapis.com/css?family=Inconsolata:400,500,600,700|Raleway:400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="{{ asset('scrumptious/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('scrumptious/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('scrumptious/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('scrumptious/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="{{ asset('scrumptious/assets/css/style.css') }}" rel="stylesheet">
    <!-- =======================================================
  * Template Name: MyPortfolio - v4.7.0
  * Template URL: https://bootstrapmade.com/myportfolio-bootstrap-portfolio-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    <!-- ======= Navbar ======= -->
    <div class="collapse navbar-collapse custom-navmenu" id="main-navbar">
        <div class="container py-2 py-md-5">
            <div class="row align-items-start">
                <div class="col-md-6">
                    <ul class="custom-menu">
                        <li class="active"><a href="{{ route('home') }}">Home</a></li>
                        @guest
                        <li><a href="{{ route('admin.index') }}">Login</a></li>
                        @endguest
                        @auth
                        <li><a href="{{ route('admin.index') }}">Admin</a></li>
                        @endauth
                    </ul>
                </div>
                <div class="col-md-6 d-none d-md-block">
                    <h3>Scrumptious</h3>
                    <p>Merupakan website penyedia layanan daftar menu dari berbagai foodpreneur. Website ini dibuat
                        untuk memenuhi keperluan tugas besar Pemrograman WEB II.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-light custom-navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Scrumptious</a>
            <a href="#" class="burger" data-bs-toggle="collapse" data-bs-target="#main-navbar">
                <span></span>
            </a>
        </div>
    </nav>
    <main id="main">
        <!-- ======= Works Section ======= -->
        @if (count($menu)==0)
        <section class="section site-portfolio">
            <div class="container">
                <div class="alert alert-primary" role="alert">
                    Masuk untuk menambahkan menu baru!
                </div>
                <div class="row mb-5 align-items-center">
                    <div class="col-md-12 col-lg-6 mb-4 mb-lg-0" data-aos="fade-up">
                        <h2>Nama toko kosong</h2>
                        <p class="mb-0">Pemilik : Kosong | Alamat : Kosong | Telepon : Kosong
                        </p>
                    </div>
                </div>
                <div id="portfolio-grid" class="row no-gutter" data-aos="fade-up" data-aos-delay="200">
                    <div class="item col-sm-12 col-md-12 col-lg-12 mb-4">
                        <div class="item-wrap fancybox">
                            <div class="work-info">
                                <h3>Nama menu kosong</h3>
                                <h3>Kategori kosong</h3>
                                <span>Harga kosong</span>
                            </div>
                            <img class="img-fluid" src="{{ asset('kosong.png') }}">
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End  Works Section -->
        @else
        @foreach ($menu as $item)
        <section class="section site-portfolio">
            <div class="container">
                <div class="row mb-5 align-items-center">
                    <div class="col-md-12 col-lg-6 mb-4 mb-lg-0" data-aos="fade-up">
                        <h2>{{ $item->nama_toko }}</h2>
                        <p class="mb-0">Pemilik : {{ $item->pemilik }} | Alamat : {{ $item->alamat }} | Telepon : {{
                            $item->no_telepon }}
                        </p>
                    </div>
                </div>
                <div id="portfolio-grid" class="row no-gutter" data-aos="fade-up" data-aos-delay="200">
                    @if (count($item->menu)>0)
                    @foreach ($item->menu as $item)
                    <div class="item col-sm-6 col-md-4 col-lg-4 mb-4">
                        <div class="item-wrap fancybox">
                            <div class="work-info">
                                <h2>{{ $item->nama_menu }}</h2>
                                <h3>{{ $item->kategori }}</h3>
                                <span>{{ $item->harga }}</span>
                            </div>
                            @if ($item->foto)
                            <img class="img-fluid" src="{{ asset('storage/'.$item->foto) }}">
                            @else
                            <img class="img-fluid" src="{{ asset('menu_kosong.png') }}">
                            @endif
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="item col-sm-12 col-md-12 col-lg-12 mb-4">
                        <div class="item-wrap fancybox">
                            <div class="work-info">
                                <h3>ha</h3>
                                <h3>ha</h3>
                                <span>ha</span>
                            </div>
                            <img class="img-fluid" src="{{ asset('kosong.png') }}">
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </section><!-- End  Works Section -->
        @endforeach
        @endif
        <div class="pagination justify-content-center">
            {{ $menu->links() }}
        </div>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer class="footer" role="contentinfo">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <p class="mb-1">&copy; Copyright Scrumptious</p>
                    <div class="credits">
                        Designed by: Khairunnisa Fitrisha-F55120038 | Andi Suhriani-F55120002
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('scrumptious/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('scrumptious/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('scrumptious/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('scrumptious/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('scrumptious/assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('scrumptious/assets/js/main.js') }}"></script>

</body>

</html>