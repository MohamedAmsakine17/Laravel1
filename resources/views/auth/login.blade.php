
@extends('layouts.app')

@section('content')
<main class="py-4">
    <div class="container">
        <div class="d-flex justify-content-center align-items-center">
            <form method="POST" action="{{ route('login') }}" class="signup-form">
                @csrf
                <div>
                    <h2  class="signup-form-title ">Connectez-vous</h2>
                    <h6  class="signup-form-semi-title text-secondary">
                        Connectez-vous à votre compte.
                    </h6>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Souviens-toi de moi') }}
                    </label>
                </div>
                
                    <div class="form-group form-submit-input">
                        <button type="submit" class="btn btn-primary form-control purple-button">
                            {{ __('Connexion') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link p-0 link" href="{{ route('password.request') }}">
                                {{ __('Mot de passe oublié?') }}
                            </a>
                        @endif
                    </div>
            </form>
        </div>
        
        <p class="text-center m-0 mt-4">Vous n'avez pas de compte ? <a class="link" href="{{ route('register') }}">Inscrivez-vous</a></p>
    </main>
@endsection
