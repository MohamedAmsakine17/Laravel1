@extends('layouts.admin')

@push('css')
    <link rel="stylesheet" href="../../css/admin.css">
@endpush

@section('content')
<main class="dashboard-main">
        <div class="dashboard-container">
            <div class="row h-100 w-100">
                <div class="col-lg-2 dashboard-left-container ">
                    <div class="admin-info">
                        <div class="admin-picture-container">
                            <div class="admin-picture" style= "background-image: url(/{{Auth::user()->path}}); background-repeat: no-repeat; background-size: cover; background-position: center;"></div>
                        </div>
                        <div class="text-center">
                            <h5>{{Auth::user()->name}}</h5>
                            <small>{{Auth::user()->role->name}}</small>
                        </div>
                    </div>
                    <hr>
                    <div class="admin-buttons">
                        <ul>
                            <li><a class="option-btn" href="{{route('adminDash')}}"> <i class="bi bi-speedometer2 me-2"></i> Tableau de bord</a></li>
                            <li class="mt-3"><a class="option-btn" href="{{route('adminUsers')}}"> <i class="bi bi-people-fill me-2"></i> Utilisateurs</a></li>
                            <li class="mt-3"><a class="option-btn" href="{{route('adminArticles')}}"> <i class="bi bi-shop me-2"></i> Des articles</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-10 dashboard-right-container">

                    <div id="users" class="container">
                        <div class="users-container">
                            <div class="admin-data-container">
                                <h2>Utilisateurs</h2>
                            </div>
                            <div class="admin-data-container">
                                <table class="table table-striped mt-4">
                                    <thead class="users-table-thead">
                                        <tr>
                                            <th scope="col">id</th>
                                            <th scope="col">img</th>
                                            <th scope="col">rôle</th>
                                            <th scope="col">Nom d'utilisateur</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Suppression</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                            <tr scope="row">
                                                <td>{{$user->id}}</td>
                                                <td><div class="user-picture" style= "background-image: url(/{{$user->path}}); background-repeat: no-repeat; background-size: cover; background-position: center;"></div></td>
                                                <td>
                                                    {{$user->role->name}}
                                                </td>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>
                                                    @if($user->role->name != 'admin')
                                                        <button type="button" class="red-button"  data-toggle="modal" data-target="#supprimerModalCenter">
                                                            Supprimer
                                                            <form id="delete-user-form" action="/admin/delete/user/{{$user->id}}" method="POST" class="d-none">
                                                                @csrf
                                                                <input type="hidden" name="_method" value="DELETE">
                                                            </form>
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
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