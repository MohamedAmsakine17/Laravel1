
@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="../../css/profile.css">
@endpush


@section('content')
<main class="main-container">
  <div class="container">
    <!--PROFILE-->
    <div class="profile-container">
      <!--Profile Background-->
      <div class="profile-background" style="background-color: #9d44f6;"></div>
      <div class="row">
        <div class="col-lg-5 col-12">
          <!--Profile Data-->
          <div class="profile-data">
            <!--Profile User Image-->
            <div class="profile-picture">
              <div class="user-picture" style= 
              "
              background-image: url({{Auth::user()->getFirstMediaUrl('userImage', 'thumb')}});
              background-repeat: no-repeat;
              background-size: cover;
              background-position: center;
              ">
              <button class="upload-picture-button" data-toggle="modal" data-target="#editPhotoModalCenter"><i class="bi bi-pencil-fill"></i></button>
              </div>
            </div>
            <!--Profile User Name-->
            <div class="user-info">
              <p class="user-name">{{Auth::user()->name}}</p>
              <p class="user-email">{{Auth::user()->email}}</p>
              <p class="user-role text-secondary">{{Auth::user()->role->name}}</p>
            </div>
          </div>
        </div>
        <div class="col-lg-7 col-12">
          <!--Profile Edit Place-->
          <div class="user-edit-data">
            <!-- User Name -->
            <div>
              <small>Nom d'utilisateur</small>
              <div class="user-data">
                <p class="user-data-text">{{Auth::user()->name}}</p>
                <button id="editNameButton" type="button" class="edit-button" data-toggle="modal" data-target="#editNameModalCenter"><i class="bi bi-pencil-fill"></i></button>
              </div>
            </div>
            <!-- User Email -->
            <div>
              <small>Email</small>
              <div class="user-data">
                <p class="user-data-text">{{Auth::user()->email}}</p>
              </div>
            </div>
            <!-- User Password -->
            <div>
              <small>Mot de passe</small>
              <div class="user-data">
                <p class="user-data-text">************</p>
                <button id="editEmailButton" type="button" class="edit-button" data-toggle="modal" data-target="#editPasswordModalCenter"><i class="bi bi-pencil-fill"></i></button>
              </div>
            </div>
            <!-- Delete -->
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
  </div>

  
        {{-- <div class="container d-flex justify-content-center align-items-center h-100">
            <div class="profile-container">
                <div class="profile-background" style="background-color: #9d44f6;"></div>
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
                        
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="container">
          @if ($errors->any())
            <div class="error-message mt-3 mb-3">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
            </div>
          @endif
        </div>

        <div class="site-features">
          <hr>
          <div class="container">
              <div class="row">
                  <div class="col-lg-4 col-12">
                      <div class="features-card">
                          <div class="features-icon"><i class="bi bi-patch-check"></i></div>
                          <div class="features-text">
                              <div class="features-title">Produits de qualité</div>
                              <div class="features-about">plus de 10 produits cinq étoiles</div>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-4 col-12">
                      <div class="features-card">
                          <div class="features-icon"><i class="bi bi-heart"></i></div>
                          <div class="features-text">
                              <div class="features-title">De confiance</div>
                              <div class="features-about">évalué par 50 000 clients</div>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-4 col-12">
                      <div class="features-card">
                          <div class="features-icon"><i class="bi bi-globe-europe-africa"></i></div>
                          <div class="features-text">
                              <div class="features-title">Soutien communautaire</div>
                              <div class="features-about">soutenu par 3 membres du forum</div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
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
                <input type="hidden" name="id" value="{{Auth::user()->id}}"/>
                <div class="form-group">
                  <label for="name">Nom d'utilisateur</label>
                  <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}">
                </div>
                <div class="form-group">
                  <label for="name">Mot de passe</label>
                  <input type="password" name="password" class="form-control">
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="purple-button" data-dismiss="modal">Fermer</button>
          <button type="button" class="yellow-button" onclick="document.getElementById('edit-username-form').submit();">Changer</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Edit Password Modal -->
  <div class="modal fade" id="editPasswordModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Changer votre mot de passe</h5>
          <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </button>
        </div>
        <div class="modal-body">
            <form id="edit-password-form" method="POST" action="{{route('updatePassword',[Auth::user()->id])}}" class="mt-3">
                @csrf
                <input type="hidden" name="_method" value="PUT"/>
                <input type="hidden" name="id" value="{{Auth::user()->id}}"/>
                <div class="form-group">
                  <label for="password">Mot de passe actuel</label>
                  <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                  <label for="newPassword">Nouveau Mot de passe</label>
                  <input type="password" name="newPassword" class="form-control">
                </div>
                <div class="form-group">
                  <label for="confirmPassword">Confirmez le mot de passe</label>
                  <input type="password" name="confirmePassword" class="form-control">
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="purple-button" data-dismiss="modal">Fermer</button>
          <button type="button" class="yellow-button" onclick="document.getElementById('edit-password-form').submit();">Changer</button>
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
                <label for="file">Changez votre image</label>
                <input type="file" name="file" id="file" class="form-control" />
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


@section('scripts')
<script>

    // get a reference to the fieldset element
    const fieldsetElement = document.querySelector('#file');

    // create a FilePond instance at the fieldset element location
    const pond = FilePond.create(fieldsetElement);

    FilePond.setOptions({
        labelIdle: 'Glisser & déposez vos image ou <span class="filepond--label-action"> Parcourez </span>',
        allowMultiple: false,
        maxFiles: 1,
        server: {
            url:'/upload',
            headers:{
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
        }
    });
    


</script>
@endsection


@endsection

