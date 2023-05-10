<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="/images/favicon.png">

    <title>DevMarketplace</title>

     <!-- Scripts -->
     @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"/>
    
    <!-- Style -->
    <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />
    @stack('css')

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="bi bi-code-square brand-icon"></i> DevMarketplace
                </a>
                <div class="search-input">
                    <div class="search-input-container">
                        <i class="bi bi-search"></i>
                    <input type="text" class="m-0 form-control" placeholder="Searh" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>
                <button class="navbar-toggler toggler-button" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="icon"><i class="bi bi-list"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link small-btn login-btn" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link small-btn signup-btn" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <hr class="d-block d-lg-none nav-h-row">
                            <li class="nav-item">
                                <a class="navbar-icons"  href="{{route('panier')}}" >
                                    <i class="bi bi-bag-heart-fill"></i>
                                    <div class="d-lg-none d-inline ms-2">Votre liste d'envies</div>
                                </a>
                            </li>
                            <hr class="d-block d-lg-none nav-h-row">
                            <li class="nav-item">
                                <a class="navbar-icons"  href="{{route('panier')}}" >
                                    <i class="bi bi-cart-fill carts-icon">
                                        @if(count(Auth::user()->carts)  > 0)
                                            <div class="carts-nomber">{{count(Auth::user()->carts)}}</div>
                                        @endif
                                    </i>
                                    <div class="d-lg-none d-inline ms-2">Panier</div>
                                    
                                </a>
                            </li>
                            <hr class="d-block d-lg-none nav-h-row">
                            <li class="nav-item">
                                <div class="dropdown show">
                                    <a class="navbar-icons" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bi bi-person-fill"></i>
                                        <div class="d-lg-none d-inline ms-2">Utilisateur</div>
                                    </a>
                                  
                                    <div class="dropdown-menu user-dropdown-menu" aria-labelledby="dropdownMenuLink">
                                      <a class="dropdown-item user-dropdown-item" href="{{route('profile')}}"> <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}</a>
                                      <hr>
                                      @if(Auth::check() && Auth::user()->role->name == 'admin')
                                      <a class="dropdown-item user-dropdown-item" href="{{route('adminDash')}}"> <i class="bi bi-speedometer2 me-2"></i> Tableau de bord</a>
                                      @endif
                                      <hr>
                                      <a class="dropdown-item user-dropdown-item" href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();">
                                            <i class="bi bi-box-arrow-right"></i> {{ __('Se déconnecter') }}
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                      </a>
                                    </div>
                                  </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @if (Auth::check())
            <nav class="second-navbar">
                <div class="container">
                    <ul class="second-navbar-list">
                        <li class="nav-item"><a href="" class="nav-link">APIs</a></li>
                        <li class="nav-item"><a href="" class="nav-link">Frameworks</a></li>
                        <li class="nav-item"><a href="" class="nav-link">UI</a></li>
                        <li class="nav-item"><a href="" class="nav-link">APPs</a></li>
                        <li class="nav-item"><a href="" class="nav-link">Unity</a></li>
                    </ul>
                </div>
            </nav>
        @endif

        {{-- <div class="web-site-news">
            Le site Web est encore en développement, s'il y a un problème ou une erreur que vous trouvez, écrivez-nous.
        </div> --}}

        @yield('nav')

        
            @yield('content')
    </div>
    <footer id="sticky-footer" class="flex-shrink-0 py-4">
        <div class="container text-center">
            <div  class="mb-3">
                <a href="https://www.facebook.com/CoreBrainsOfficial/" target="_blank" class="footer-icons"><i class="bi bi-facebook"></i></a>
                <a href="https://twitter.com/corebrainz" target="_blank" class="footer-icons"><i class="bi bi-twitter"></i></a>
                <a href="https://www.instagram.com/corebrainz/" target="_blank" class="footer-icons"><i class="bi bi-instagram"></i></a>
                <a href="https://www.youtube.com/@COREBRAINZ" target="_blank" class="footer-icons"><i class="bi bi-youtube"></i></a>
                <a href="https://www.linkedin.com/in/me2dev/" target="_blank" class="footer-icons"><i class="bi bi-linkedin"></i></a>
            </div>
          <small class="text-secondary">Copyright &copy; Amsakine & ElAffati</small>
        </div>
    </footer>
   
    <!-- Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    @yield('scripts')
</body>
</html>
