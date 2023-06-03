@extends('layouts.app')
{{-- Mohamed Amsakine & Saad El Affati --}}

@push('css')
    <style>
        .email-icon {
            background-color: var(--light-purple);
            border-radius: 50%; 
            display: flex;
            align-items: center;
            width: fit-content;
            margin: auto;
            padding: 12px;
            border: 8px solid #efdfff;
        }

        .email-icon .material-icons-outlined {
            font-size: 40px;
            color: var(--purple);
        }

        .content-container {
            font-size: 1.2rem;
            font-weight: 500; 
        }
        
        .user-email,
        .verify,
        .welcom-text {
            font-weight: bold; 
        }

        .user-email {
            color: var(--purple);
        }

        .verfiy-button {
            font-size: 1.3rem;
            font-weight: bold;
            padding: 30px 15px
        }
        
    </style>
@endpush


@section('content')
<main class="py-4">
<div class="container text-center">
    <div class="email-icon">
        <span class="material-icons-outlined">
            email
        </span>
    </div>
    <h2 class="welcom-text mt-4 mb-4">
        Veuillez vérifier votre e-mail
    </h2>
    <div class="content-container">
        <p class="mb-1">Tu y es presque! Nous avons envoyé un e-mail à</p>
        <p class="user-email">{{Auth::user()->email}}</p>
        <p class="mt-4">Cliquez simplement sur le lien contenu dans cet e-mail pour terminer votre inscription. 
        <br>  si vous ne le voyez pas, vous devrez peut-être <span class="verify">vérifier votre dossier spam</span>.</p>
        <p class="mt-4">Vous ne trouvez toujours pas l'e-mail ? Aucun problème.</p>
    </div>
    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="purple-button verfiy-button mt-4 mb-4">{{ __('Renvoyer l\'e-mail de vérification') }}</button>.
    </form>

</div>
</main>
@endsection
