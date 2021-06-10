<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" href="/css/estilos.css">
    <link rel="stylesheet" href="/css/catalogo.css">

    <title>MagicShirts</title>
</head>

<body>
    <header>
        <div id="logo">
            <img src="/img/plain_white.png" alt="Logo">
        </div>
        <h1>Loja MagicShirts</h1>
        @auth
            <div class="avatar-area">
                <span class="name-user">{{ Auth::user()->name }}</span>
                @isset(Auth::user()->url_foto)
                    <img class="img-profile rounded-circle" src="{{ asset('storage/fotos/' . Auth::user()->url_foto) }}">
                @else
                    <div class="circle">
                        <span class="initials">&nbsp;{{ generateInitials(Auth::user()->name) }}</span>
                    </div>
                @endisset
            </div>
        @else
            <div class="avatar-area">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
            </div>
        @endauth
        <div id="menuIcon">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
    </header>
    <div class="container">
        <nav>
            <ul>
                <li class="{{ Route::currentRouteName() == 'home' ? 'sel' : '' }}">
                    <i class="fas fa-info-circle"></i>
                    <a href="{{ route('home') }}">Apresentação</a>
                </li>

                <li class="{{ Route::currentRouteName() == 'catalogo.index' ? 'sel' : '' }}">
                    <i class="fas fa-box-open"></i>
                    <a href="{{ route('catalogo.index') }}">Catálogo</a>
                </li>

                <li class="{{ Route::currentRouteName() == 'carrinho.index' ? 'sel' : '' }}">
                    <i class="fas fa-shopping-cart"></i>
                    <a href="{{ route('carrinho.index') }}">Carrinho</a>
                </li>

                @auth
                    <li>
                        <i class="fab fa-wpforms"></i>
                        <a href="{{ route('admin.dashboard') }}">Administração</a>
                    </li>

                    <li>
                        <i class="fab fa-wpforms"></i>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                                    document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endauth
            </ul>
        </nav>

        <section id="main">
            <div class="content">
                <div class="left-content">
                    @if (session('alert-msg'))
                        <div class="alert alert-{{ session('alert-type') }}">
                            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                            <span>{{ session('alert-msg') }}</span>
                        </div>
                    @endif
                    @yield('content')
                </div>
            </div>
            <footer>
                <p>
                    © <a href="mailto:	coord.dei.estg@ipleiria.pt"> Departamento de Engenharia Informática</a>
                </p>
            </footer>

        </section>
    </div>

    <script src="js/menu.js"></script>
</body>

</html>
