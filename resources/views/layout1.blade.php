<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">

    @yield('styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
</head>

<body>

    <div class="page">
        <nav class="page__menu menu">

            <ul class="menu__list r-list">
                <div id="logo">
                    <img src="/img/plain_white.png" alt="Logo">
                </div>
                <li class="menu__group"><a href="{{ route('home') }}"
                        class="menu__link r-link text-underlined">Inicio</a></li>
                <li class="menu__group"><a href="{{ route('catalogo.index') }}"
                        class="menu__link r-link text-underlined">Catalogo</a></li>
                <li class="menu__group"><a href="{{ route('carrinho.index') }}"
                        class="menu__link r-link text-underlined">Carrinho</a></li>
                <li class="menu__group"><a href="{{ route('admin.catalogo.estampas.create') }}"
                        class="menu__link r-link text-underlined">Criar Estampa</a></li>
                @auth
                    <div class="avatar-area">
                        <span class="name-user">{{ Auth::user()->name }}</span>
                        @isset(Auth::user()->url_foto)
                            <img class="img-profile rounded-circle"
                                src="{{ asset('storage/fotos/' . Auth::user()->url_foto) }}">
                        @else
                            <div class="circle">
                                <span class="initials">&nbsp;{{ generateInitials(Auth::user()->name) }}</span>
                            </div>
                        @endisset
                        <span style="padding: 5px">-
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"
                                class="menu__link r-link text-underlined" style="padding: 2px">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </span>
                    </div>
                @else
                    <div class="avatar-area">
                        <a class="menu__link r-link text-underlined" href="{{ route('login') }}"
                            style="padding: 5px">Login</a>
                        <a class="menu__link r-link text-underlined" href="{{ route('clientes.create') }}"
                            style="padding: 5px">Register</a>
                    </div>
                @endauth
            </ul>
        </nav>
    </div>


    <div class="main">
        @yield('content')
    </div>
    <div>
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                class="bi bi-arrow-up-short"></i></a>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>

</html>
