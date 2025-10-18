<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kripik Cemilan Enak') - Gurih & Renyah</title>

    {{-- CSS Libraries --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    {{-- Custom Styles --}}
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        /* Navbar with "Frosted Glass" effect */
        .navbar-custom {
            background-color: rgba(33, 37, 41, 0.85);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .navbar-brand,
        .nav-link {
            font-weight: 600;
        }

        .nav-link:hover {
            color: #ffc107 !important; /* Yellow hover color */
        }

        .dropdown-menu {
            backdrop-filter: blur(10px);
            background-color: rgba(33, 37, 41, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .dropdown-item {
            color: #f8f9fa;
        }

        .dropdown-item:hover {
            background-color: #ffc107;
            color: #212529;
        }

        /* Fade-in animation for content */
        .content-wrapper {
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Enhanced Footer */
        .footer-custom {
            background: linear-gradient(90deg, #212529, #343a40); /* Dark gradient */
            color: white;
        }

        .footer-custom .social-icon {
            font-size: 1.5rem;
            color: white;
            transition: color 0.3s ease;
        }

        .footer-custom .social-icon:hover {
            color: #ffc107; /* Yellow hover color */
        }

        /* Back to Top Button */
        #btn-back-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }

        #btn-back-to-top:hover {
            opacity: 1;
        }
    </style>
    @stack('styles')
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="bi bi-box-seam-fill me-2"></i>Kripik Cemilan Enak
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('produk') ? 'active' : '' }}" href="{{ url('/produk') }}">Produk</a>
                    </li>
                </ul>

                {{-- Authentication & Cart Section --}}
                <div class="d-flex align-items-center">
                    {{-- Cart Icon --}}
                    <a href="{{ url('/keranjang') }}" class="nav-link text-white position-relative me-3">
                        <i class="fas fa-shopping-cart fa-lg"></i>
                        @php
                            $cartCount = count(session('cart', []));
                        @endphp
                        <span id="cart-count"
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                            @if ($cartCount == 0) style="display: none;" @endif>
                            {{ $cartCount }}
                        </span>
                    </a>

                    {{-- User Authentication Logic --}}
                    @auth
                        {{-- IF USER IS LOGGED IN --}}
                        @if (Auth::user()->role == 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-success me-2">Menu Admin</a>
                        @else
                            <a href="{{ route('user.dashboard') }}" class="btn btn-sm btn-info me-2">Menu Pelanggan</a>
                        @endif

                        <div class="dropdown">
                            <a href="#" class="nav-link text-white dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle fa-lg me-1"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profil Saya</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Keluar</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        {{-- IF USER IS A GUEST (NOT LOGGED IN) --}}
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-2">Masuk</a>
                        <a href="{{ route('register') }}" class="btn btn-warning btn-sm">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="content-wrapper py-4">
        @yield('content')
    </main>

    <footer class="footer-custom pt-5 pb-4">
        <div class="container text-center text-md-start">
            <div class="row text-center">
                <div class="col-12 mb-4">
                    <h5 class="text-uppercase fw-bold">Anggota Kelompok</h5>
                </div>
                <div class="col-12 d-flex flex-wrap justify-content-center mb-3">
                    <div class="col-md-4 col-sm-6 mb-3">
                        <h6 class="fw-bold mb-1">Aby Alfatih</h6>
                        <p class="small mb-0">231011403185</p>
                    </div>
                    <div class="col-md-4 col-sm-6 mb-3">
                        <h6 class="fw-bold mb-1">Palgunadi</h6>
                        <p class="small mb-0">231011400115</p>
                    </div>
                    <div class="col-md-4 col-sm-6 mb-3">
                        <h6 class="fw-bold mb-1">Reinardus Di Caprio Kadju</h6>
                        <p class="small mb-0">231011400112</p>
                    </div>
                </div>
                <div class="col-12 d-flex flex-wrap justify-content-center">
                    <div class="col-md-4 col-sm-6 mb-3">
                        <h6 class="fw-bold mb-1">Wisnu Kuntjoro Adji</h6>
                        <p class="small mb-0">2310114035565</p>
                    </div>
                    <div class="col-md-4 col-sm-6 mb-3">
                        <h6 class="fw-bold mb-1">Zukhruf Gharrick Marius</h6>
                        <p class="small mb-0">231011401735</p>
                    </div>
                </div>
            </div>
            <div class="text-center mt-3 border-top border-secondary pt-3">
                <p class="mb-0">&copy; {{ date('Y') }} Kripik Cemilan Enak. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <button type="button" class="btn btn-warning btn-floating" id="btn-back-to-top">
        <i class="bi bi-arrow-up-short fs-4"></i>
    </button>

    {{-- JavaScript Libraries --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Custom Scripts --}}
    <script>
        // Back to Top Button Logic
        let mybutton = document.getElementById("btn-back-to-top");
        window.onscroll = function() {
            scrollFunction();
        };

        function scrollFunction() {
            if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }
        mybutton.addEventListener("click", function() {
            document.body.scrollTop = 0; // For Safari
            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
        });
    </script>
    @stack('scripts')
</body>

</html>