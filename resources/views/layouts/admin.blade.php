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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <!-- Style -->
    <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />
    @stack('css')
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />

</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <div class="d-flex align-items-center">
                <button class="menu-toggler-button" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                    <span class="material-icons-outlined menu-toggler-icon">
                        menu
                    </span>
                </button>
                <div id="dashboard-menu">
                    <a href="{{ url('/') }}" class="dashboard-brand">DevMarketplace</a>
                </div>
            </div>
            <div class="admin-info d-md-block d-none">
                <div class="admin-info-text">
                    <div class="admin-picture-container">
                        <div class="admin-picture" style= "background-image: url({{Auth::user()->getFirstMediaUrl('userImage', 'thumb')}}); background-repeat: no-repeat; background-size: cover; background-position: center;"></div>
                    </div>
                    <div>
                        <h5>{{Auth::user()->name}}</h5>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    
    <div class="offcanvas offcanvas-start admin-menu-side" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header">
            <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="offcanvas" aria-label="Close">
            </button>
        </div>
        <div class="offcanvas-body">
            <div class="admin-canvas-container">
                <div class="admin-canvas-image-container">
                    <div class="picture" style= "background-image: url({{Auth::user()->getFirstMediaUrl('userImage', 'thumb')}}); background-repeat: no-repeat; background-size: cover; background-position: center;"></div>
                </div>
                <h3 class="admin-canvas-name">{{Auth::user()->name}}</h3>
            </div>

            <hr class="admin-canvas-hr">

            <div class="admin-menu">
                <ul class="menu-list">
                    <li>
                        <a class="option-btn" href="{{route('adminDash')}}"> 
                            <span class="material-icons-outlined menu-icon">
                            dashboard
                            </span>
                            <div class="expand-item">Tableau de bord</div> 
                        </a>
                    </li>
                    <li class="mt-5">
                        <a class="option-btn" href="{{route('adminUsers')}}">
                            <span class="material-icons-outlined menu-icon">
                                people_alt
                            </span>
                            <div class="expand-item">Utilisateurs</div>
                        </a>
                    </li>
                    <li class="mt-5">
                        <a class="option-btn" href="{{route('adminArticles')}}"> 
                            <span class="material-icons-outlined menu-icon">
                                storefront
                            </span>
                            <div class="expand-item">Des articles</div>
                        </a>
                    </li>
                    
                    <li class="mt-5">
                        <a class="option-btn" href="{{route('adminTrashed')}}"> 
                            <span class="material-icons-outlined menu-icon">
                                delete
                                </span>
                            <div class="expand-item">Poubelle</div>
                        </a>
                    </li>
                    <li class="mt-5">
                        <a class="option-btn" href="{{ route('logout') }}"> 
                            <span class="material-icons-outlined menu-icon">
                                logout
                            </span>
                            <div class="expand-item">Se déconnecter</div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
      
    <div class="dashboard-container">
        {{-- <div class="dashboard-left-container">
            <div class="header">
                <div id="dashboard-menu" class="content-collapse expand-item">
                    <a href="{{ url('/') }}" class="dashboard-brand">DevMarketplace</a>
                </div>
                <button class="dashboard-menu-toggler">
                    <span class="material-icons-outlined menu-toggler-icon">
                        menu
                    </span>
                </button>
            </div>
            <div class="admin-menu">
                <ul class="menu-list">
                    <li>
                        <a class="option-btn" href="{{route('adminDash')}}"> 
                            <span class="material-icons-outlined menu-icon">
                            dashboard
                            </span>
                            <div class="expand-item">Tableau de bord</div> 
                        </a>
                    </li>
                    <li class="mt-5">
                        <a class="option-btn" href="{{route('adminUsers')}}">
                            <span class="material-icons-outlined menu-icon">
                                people_alt
                            </span>
                            <div class="expand-item">Utilisateurs</div>
                        </a>
                    </li>
                    <li class="mt-5">
                        <a class="option-btn" href="{{route('adminArticles')}}"> 
                            <span class="material-icons-outlined menu-icon">
                                storefront
                            </span>
                            <div class="expand-item">Des articles</div>
                        </a>
                    </li>
                    <li class="mt-5">
                        <a class="option-btn" href="{{route('adminArticles')}}"> 
                            <span class="material-icons-outlined menu-icon">
                                chat
                            </span>
                            <div class="expand-item">Blog</div>
                        </a>
                    </li>
                    <li class="mt-5">
                        <a class="option-btn" href="{{ route('logout') }}"> 
                            <span class="material-icons-outlined menu-icon">
                                logout
                            </span>
                            <div class="expand-item">Se déconnecter</div>
                        </a>
                    </li>
                </ul>
            </div>
        </div> --}}
            
        @yield('content')
    </div>
    
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    @livewireScripts
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    @yield('scripts')
    <script>
        
    </script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
