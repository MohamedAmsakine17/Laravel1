@extends('layouts.admin')

@push('css')
    <link rel="stylesheet" href="../../css/admin.css">
@endpush

@section('content')
<main class="dashboard-main">
                <div class="dashboard-right-container">
                    <div class="container">
                        <div class="dashboard-header">
                            <h2>Utilisateurs</h2>
                            
                        </div>
                        <hr>


                        <div class="users-container">
                            <div class="admin-data-container">
                                <livewire:users /> 
                            </div>
                        </div>
                    </div>
                </div>
</main>


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
            Vous êtes sûr de vouloir supprimer ce compte?
        </div>
        <div class="modal-footer">
          <button type="button" class="purple-button" data-dismiss="modal">Fermer</button>
          <button type="button" class="red-button" onclick="document.getElementById('delete-user-form').submit();">Supprimer</button>
        </div>
      </div>
    </div>
  </div>

@endsection