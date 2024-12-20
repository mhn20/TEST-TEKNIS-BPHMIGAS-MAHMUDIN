<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $datawebsite->title }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="{{ $datawebsite->icon }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ $datawebsite->icon }}">

    <link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/templatemo.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/custom.css') }}">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="{{ asset('assets/front/css/fontawesome.min.css') }}">
<!--
    
TemplateMo 559 Zay Shop

https://templatemo.com/tm-559-zay-shop

-->
</head>

<body>
    <!-- Start Top Nav -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div>
                    <i class="fa fa-envelope mx-2"></i>
                    <i class="fa fa-phone mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="https://wa.me/{{ $datawebsite->telp }}?text=Saya Tertarik Untuk Memesannya">{{ $datawebsite->telp }}</a>
                </div>
                <div>
                    {{ $datawebsite->alamat }}
                </div>
            </div>
        </div>
    </nav>
    <!-- Close Top Nav -->


    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand text-success logo h1 align-self-center" href="/">
                <img src="{{ $datawebsite->icon }}" class="img-fluid">
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/contact">Contact</a>
                        </li>
                    </ul>
                </div>
                <div class="navbar align-self-center d-flex">
                    <a class="nav-icon position-relative text-decoration-none" href="#">
                        <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                        <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark">7</span>
                    </a>
                </div>
            </div>

        </div>
    </nav>
    <!-- Close Header -->


    @if($dataslider)
    <!-- Start Banner Hero -->
    <div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            @foreach(@$dataslider as $rowindex)
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="{{ $rowindex->no }}" class="{{ $rowindex->no==0?'active':'' }}"></li>
            @endforeach
        </ol>
        <div class="carousel-inner">
            @foreach(@$dataslider as $rowindex)
            <div class="carousel-item {{ $rowindex->no==0?'active':'' }}">
                <div class="container">
                    <div class="row p-5">
                        <div class="col-md-12 order-lg-last">
                            <img class="img-fluid" src="{{ $rowindex->images }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
            <i class="fas fa-chevron-left"></i>
        </a>
        <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
            <i class="fas fa-chevron-right"></i>
        </a>
    </div>
    <!-- End Banner Hero -->
    @endif

    @yield('contents')


    <!-- Start Footer -->
    <footer class="bg-dark" id="tempaltemo_footer">

        <div class="w-100 bg-black py-3">
            <div class="container">
                <div class="row pt-2">
                    <div class="col-12">
                        <p class="text-left text-light">
                            {{ $datawebsite->footer }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    <!-- End Footer -->

    <!-- Start Script -->
    <script src="{{ asset('assets/front/js/jquery-1.11.0.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/jquery-migrate-1.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/templatemo.js') }}"></script>
    <script src="{{ asset('assets/front/js/custom.js') }}"></script>
    <!-- End Script -->
</body>

</html>