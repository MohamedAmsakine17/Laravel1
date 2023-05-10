{{-- Mohamed Amsakine & Saad El Affati --}}

@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="../../css/profile.css">
@endpush


@section('content')
<main class="py-4">
        <div class="container d-flex justify-content-center align-items-center h-100">
            <div class="profile-container">
                <div class="profile-background" style="background-color: #9d44f6; "></div>
                <div class="d-flex profile-info">
                    <div class="me-5 profile-picture-container">
                        <button class="upload-picture-button" data-toggle="modal" data-target="#editPhotoModalCenter">
                            <div class="profile-picture" style= 
                            "
                            background-image: url({{Auth::user()->path}});
                            background-repeat: no-repeat;
                            background-size: cover;
                            background-position: center;
                            "></div>
                        </button>
                    </div>
                    <div class="profile-user-info-container">
                        <h3>{{Auth::user()->name}}</h3>
                        <div class="profile-user-info mt-4">
                            <div class="user-info mb-2">
                                <small>Nom d'utilisateur</small>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="m-0">{{Auth::user()->name}}</p>
                                    <button id="editNameButton" type="button" class="user-info-edit-button" data-toggle="modal" data-target="#editNameModalCenter"><i class="bi bi-pencil-fill"></i></button>
                                </div>
                            </div>
                            <div class="user-info">
                                <small>Email</small>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="m-0">{{Auth::user()->email}}</p>
                                    <button class="user-info-edit-button"><i class="bi bi-pencil-fill"></i></button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="red-button mt-3"  data-toggle="modal" data-target="#supprimerModalCenter">
                            Supprimer le compte
                            <form id="delete-form" action="/user/delete/{{Auth::user()->id}}" method="POST" class="d-none">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                            </form>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
          @if ($errors->any())
            <div class="error-message">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
            </div>
          @endif
        </div>
    

  <!-- Supprimer Modal -->
  <div class="modal fade" id="supprimerModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Suppression de compte</h5>
          <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </button>
        </div>
        <div class="modal-body">
            Si vous supprimez votre compte, vous ne pourrez plus l'utiliser et toutes vos données seront supprimées
        </div>
        <div class="modal-footer">
          <button type="button" class="purple-button" data-dismiss="modal">Fermer</button>
          <button type="button" class="red-button" onclick="document.getElementById('delete-form').submit();">Supprimer</button>
        </div>
      </div>
    </div>
  </div>


   <!-- Edit Name Modal -->
   <div class="modal fade" id="editNameModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Changer votre nom d'utilisateur</h5>
          <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </button>
        </div>
        <div class="modal-body">
            Entrez un nouveau nom d'utilisateur.
            <form id="edit-username-form" method="POST" action="{{route('updateUsername',[Auth::user()->id])}}" class="mt-3">
                @csrf
                <input type="hidden" name="_method" value="PUT"/>
                <label for="name">Nom d'utilisateur</label>
                <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}">
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="purple-button" data-dismiss="modal">Fermer</button>
          <button type="button" class="yellow-button" onclick="document.getElementById('edit-username-form').submit();">Changer</button>
        </div>
      </div>
    </div>
  </div>






   <!-- Edit Photo Modal -->
   <div class="modal fade" id="editPhotoModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Choisissez une nouvelle photo de profil.</h5>
          <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </button>
        </div>
        <div class="modal-body">
            <form id="edit-photo-form" method="POST" action="{{route('updatePhoto',Auth::user()->id)}}" class="mt-3" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT"/>
                <input type="file" id="picture" name="picture" class="form-control" />
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="purple-button" data-dismiss="modal">Fermer</button>
          <button type="button" class="yellow-button" onclick="document.getElementById('edit-photo-form').submit();">Changer</button>
        </div>
      </div>
    </div>
  </div>



</main>
@endsection

