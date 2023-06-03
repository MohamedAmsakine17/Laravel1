<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="/images/favicon.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <title>DevMarketplace</title>

     <!-- Scripts -->
     @vite(['resources/sass/app.scss', 'resources/js/app.js'])

     @livewireStyles
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"/>
    
    <!-- Style -->
    <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />
    @stack('css')
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="bi bi-code-square brand-icon"></i> DevMarketplace
                </a>
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
                                    <a class="nav-link small-btn login-btn" href="{{ route('login') }}">{{ __('Connexion') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link small-btn signup-btn" href="{{ route('register') }}">{{ __('Enregistrer') }}</a>
                                </li>
                            @endif
                        @else
                            <hr class="d-block d-lg-none nav-h-row">
                              <li class="nav-item">
                                <a class="navbar-icons"  href="{{route('assets')}}" >
                                  <i class="bi bi-file-arrow-down-fill"></i>
                                    <div class="d-lg-none d-inline ms-2">Vos atouts</div>
                                </a>
                            </li>
                            <hr class="d-block d-lg-none nav-h-row">
                            <li class="nav-item">
                                <a class="navbar-icons"  href="{{route('saves')}}" >
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
                                  
                                    <div class="dropdown-menu user-dropdown-menu " aria-labelledby="dropdownMenuLink">
                                      <div class="user-dropdown-item-header">
                                        <div class="user-dropdown-image">
                                          <div class="picture" style= "background-image: url({{Auth::user()->getFirstMediaUrl('userImage', 'thumb')}}); background-repeat: no-repeat; background-size: cover; background-position: center;"></div>
                                        </div>
                                        <div>
                                          <div class="user-dropdown-name">
                                            {{ Auth::user()->name }}
                                          </div>
                                          <div class="user-dropdown-email">
                                            {{ Auth::user()->email }}
                                          </div>
                                      </div>
                                      </div>
                                      <a class="dropdown-item user-dropdown-item" href="{{route('profile')}}"> <i class="bi bi-person-circle"></i> Votre compte</a>
                                      <hr class="user-dropdown-row">
                                      @if(Auth::check() && Auth::user()->role->name == 'admin')
                                      <a class="dropdown-item user-dropdown-item" href="{{route('adminDash')}}"> <i class="bi bi-speedometer2 me-2"></i> Tableau de bord</a>
                                      @endif
                                      <a class="dropdown-item user-dropdown-item phone-desactive" href="{{route('panier')}}"> <i class="bi bi-cart-fill carts-icon"></i> Panier</a>
                                      <a class="dropdown-item user-dropdown-item phone-desactive" href="{{route('assets')}}"> <i class="bi bi-file-arrow-down-fill"></i> Vos atouts </a>
                                      <a class="dropdown-item user-dropdown-item phone-desactive" href="{{route('saves')}}"> <i class="bi bi-bag-heart-fill"></i> Produits enregistrés</a>
                                      <hr class="user-dropdown-row">
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
                            <hr class="d-block d-lg-none nav-h-row">
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @if (Auth::check())
            <nav class="second-navbar">
                <div class="container">
                    <ul class="second-navbar-list">
                        <li class="nav-item"><a href="{{route('articles',['php','popular',4])}}" class="nav-link">PHP</a></li>
                        <li class="nav-item"><a href="{{route('articles',['plugins','popular',4])}}" class="nav-link">Plugins</a></li>
                        <li class="nav-item"><a href="{{route('articles',['ui','popular',4])}}" class="nav-link">Modèles</a></li>
                        <li class="nav-item"><a href="{{route('articles',['app','popular',4])}}" class="nav-link">APPs</a></li>
                        <li class="nav-item"><a href="{{route('articles',['unity','popular',4])}}" class="nav-link">Unity</a></li>
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
    <!-- Footer -->
<footer class="text-center text-lg-start">
    <!-- Section: Social media -->
    <section class="footer-social-media d-flex justify-content-center justify-content-lg-between p-4">
      <!-- Left -->
      <div class="me-5 d-none d-lg-block">
        <span>Rejoignez-nous sur les réseaux sociaux :</span>
      </div>
      <!-- Left -->
  
      <!-- Right -->
      <div>
        <a href="https://www.facebook.com/profile.php?id=100009592634489" target=”_blank” class="me-4 text-reset footer-icons">
            <i class="bi bi-facebook"></i>
        </a>
        <a href="https://twitter.com/AmsakineMohamed" target=”_blank” class="me-4 text-reset footer-icons">
            <i class="bi bi-twitter"></i>
        </a>
        <a href="https://www.instagram.com/med_amsakine/" target=”_blank” class="me-4 text-reset footer-icons">
            <i class="bi bi-instagram"></i>
        </a>
        <a href="https://www.linkedin.com/in/me2dev/" target=”_blank” class="me-4 text-reset footer-icons">
            <i class="bi bi-linkedin"></i>
        </a>
        <a href="https://github.com/MohamedAmsakine17" target=”_blank” class="me-4 text-reset footer-icons">
            <i class="bi bi-github"></i>
        </a>
      </div>
      <!-- Right -->
    </section>
    <!-- Section: Social media -->
  
    <!-- Section: Links  -->
    <section class="">
      <div class="container text-center text-md-start mt-5">
        <!-- Grid row -->
        <div class="row mt-3">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <h6 class="text-uppercase fw-bold mb-4">
                <i class="bi bi-code-square brand-icon"></i> DevMarketplace
            </h6>
            <p>
                un marché où vous pouvez acheter des outils utiles pour vous en tant que programmeur.
            </p>
          </div>
          <!-- Grid column -->
  
          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
            DES PRODUITS
            </h6>
            <p>
              <a href="{{route('articles',['php','popular',4])}}" class=" footer-link">PHP Scripts</a>
            </p>
            <p>
              <a href="{{route('articles',['plugins','popular',4])}}" class=" footer-link">Plugins</a>
            </p>
            <p>
              <a href="{{route('articles',['ui','popular',4])}}" class=" footer-link">MODÈLES</a>
            </p>
            <p>
              <a href="{{route('articles',['app','popular',4])}}" class=" footer-link">APPs</a>
            </p>
            <p>
                <a href="{{route('articles',['unity','popular',4])}}" class=" footer-link">Unity</a>
              </p>
          </div>
          <!-- Grid column -->
  
          <!-- Grid column -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
                LIENS UTILES
            </h6>
            <p>
              <a href="{{route('profile')}}" class=" footer-link">Profile</a>
            </p>
            <p>
              <a href="{{route('panier')}}" class=" footer-link">Panier</a>
            </p>
            <p>
              <a href="#!" class=" footer-link">Enregistré</a>
            </p>
          </div>
          <!-- Grid column -->
  
          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
            <p><i class="bi bi-house"></i> Maroc , Sale Sidi Abdellah</p>
            <p>
                <i class="bi bi-envelope-at"></i>
              mohamedamsakine17@gmail.com
            </p>
            <p><i class="bi bi-telephone"></i> + 212 689-782475</p>
            <p><i class="bi bi-telephone"></i> + 212 674-619126</p>
          </div>
          <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>
    </section>
    <!-- Section: Links  -->
  
    <!-- Copyright -->
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
      © 2023 Copyright:
      Mohamed Amsakine
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
    <!-- Bootstrap -->
    @livewireScripts
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    @yield('scripts')
    <script>
        $('.page-item.disabled[aria-label="« Previous"] .page-link').text("Précédent");
        $('.page-link[rel~="prev"]').text("Précédent");
        $('.page-item.disabled[aria-label="Next »"] .page-link').text("Suivant");
        $('.page-link[rel~="next"]').text("Suivant");
    </script>
</body>
</html>
