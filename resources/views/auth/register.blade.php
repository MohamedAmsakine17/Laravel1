@extends('layouts.app')

@section('content')
<main class="py-4">
<div class="container">
    <div class="d-flex justify-content-center align-items-center">
        <form method="POST" action="{{ route('register') }}" class="signup-form">
            @csrf
            <div>
                <h2  class="signup-form-title">Inscrivez-vous</h2>
                <h6  class="signup-form-semi-title text-secondary">Déjà membre? 
                    <a class="link" href="{{route('login')}}">Connexion</a>
                </h6>
            </div>
            <div class="form-group">
                <label for="name">Nom d'utilisateur</label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required >
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input id="password" type="password" class="form-control  @error('password') is-invalid @enderror form-controls" name="password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Confirmez le mot de passe</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
            <div class="form-group form-submit-input">
                <input type="submit" value="S'inscrire" class="form-control purple-button text-center">
            </div>
        </form>        
    </div>
</div>
</main>
@endsection 




{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection





<!-- Mine -->

@extends('layout.app')

@section('nav')

    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container">
            <div class="navbar-brand m-auto">
                <i class="bi bi-code-square brand-icon"></i> DevMarketplace
            </div>
        </div>
    </nav>

@endsection

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center align-items-center">
            <form method="POST" action="/signup" class="signup-form">
                @csrf
                <div>
                    <h2  class="signup-form-title ">Connectez-vous</h2>
                    <h6  class="signup-form-semi-title text-secondary">
                        Connectez-vous à votre compte.
                    </h6>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="form-group">
                    <a class="link" href="">Mot de passe oublié?</a>
                </div>
                <div class="form-group form-submit-input">
                    <input type="submit" value="Se connecter" class="form-control purple-button">
                </div>
            </form>
        </div>
        
        <p class="text-center m-0 mt-4">Vous n'avez pas de compte ? <a class="link" href="{{route('signup.create')}}">Inscrivez-vous</a></p>

        @if(count($errors)>0)
                <ul class="form-errors-list">
                    @foreach($errors->all() as $error)
                        <li>
                            <div class="form-error bg-danger">
                                <p class="m-0 ">{{$error}}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
        @endif
    </div>

@endsection


@section('footer')

    <footer id="sticky-footer" class="flex-shrink-0 py-4 bg-dark">
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

@endsection --}}