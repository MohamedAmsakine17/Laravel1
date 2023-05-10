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

                    <div class="container">
                        <div class="articles-container">
                            <div class="admin-data-container">
                                <h2>Articles</h2>
                                <a class="green-button create-article-button mt-3" href="/article/create"> <i class="bi bi-patch-plus me-3"></i><span>Ajouter un nouveau produit</span></a>
                            </div>
                            <div class="admin-data-container">
                                <table class="table table-striped mt-4">
                                    <thead class="users-table-thead">
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Nom</th>
                                            <th scope="col">Titre</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Vendeur</th>
                                            <th scope="col">Prix</th>
                                            <th scope="col">Téléchargements</th>
                                            <th scope="col">Modification</th>
                                            <th scope="col">Suppression</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($articles as $article)
                                            <tr scope="row">
                                               <td>{{$article->id}}</td>
                                               <td><a class="link" href="/article/{{$article->id}}">{{$article->product->name}}</a></td>
                                               <td>{{$article->title}}</td>
                                               <td>{{$article->description}}</td>
                                               <td>{{$article->user->name}}</td>
                                               <td>{{$article->product->price}}</td>
                                               <td></td>
                                               <td>
                                                    <a href="/article/{{$article->id}}/edit" class="yellow-button">Modifier</a>
                                               </td>
                                               <td>
                                                    <form id="delete-article-form" action="/article/{{$article->id}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="submit" class="red-button" value="Supprimer">
                                                    </form>
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




 {{-- <!-- Supprimer Modal -->
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
            Vous êtes sûr de vouloir supprimer cette article?
        </div>
        <div class="modal-footer">
          <button type="button" class="purple-button" data-dismiss="modal">Fermer</button>
          <button type="button" class="red-button" onclick="document.getElementById('delete-article-form').submit();">Supprimer</button>
        </div>
      </div>
    </div>
  </div> --}}



<!-- Ajouter Produit Modal -->
 <div class="modal fade" id="ajouterProduitModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Ajouter un nouveau produit.</h5>
          <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </button>
        </div>
        <div class="modal-body">
            <form id="create-articl-form" method="POST" action="{{route('createArticle',[Auth::user()->id])}}" class="mt-3" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div>
                        <label for="files" class="upload-button"><i class="bi bi-cloud-arrow-down"></i></label>
                        <p class="text-center h6 mt-2">Upload File</p>
                        <input id="files" name="file" style="visibility:hidden;" type="file">
                      </div>
                </div>
                <div class="form-group">
                    <label for="name">Nom de produit</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Entrez le nom de produit">
                </div>
                <div class="form-group">
                    <label for="title">Tite</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Entrez le titre de l'article produit">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea type="text" name="description" id="description" class="form-control" placeholder="Entrez la description du produit"></textarea>
                </div>
                <div class="form-group">
                    <label for="category">Tite</label>
                    <select name="category" id="category" class="form-control">
                        <option value="api">API</option>
                        <option value="framework">Framework</option>
                        <option value="ui">UI</option>
                        <option value="app">APP</option>
                        <option value="unity">Unity</option>
                    </select>
                </div>
                <div class="form-group d-flex">
                    <div>
                        <label for="price">Prix</label>
                        <input type="number" name="price" id="price" class="form-control" placeholder="0 DH" min="0"/>
                    </div>
                    <div class="ms-2">
                        <label for="promo">Promo</label>
                        <select name="promo" id="promo" class="form-control">
                            <option value="100">0%</option>
                            <option value="10">10%</option>
                            <option value="25">25%</option>
                            <option value="50">50%</option>
                            <option value="70">70%</option>
                            <option value="90">90%</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="images">Images</label>
                    <table class="table table-striped mt-4">
                        <thead class="users-table-thead">
                            <tr>
                                <th scope="col">Configuration</th>
                                <th scope="col">Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr scop="row">
                                <td>Première image</td>
                                <td>
                                    <input type="file" name="img1" class="form-control">
                                </td>
                            </tr>
                            <tr scop="row">
                                <td>Deuxième image</td>
                                <td>
                                    <input type="file" name="img2" class="form-control">
                                </td>
                            </tr>
                            <tr scop="row">
                                <td>Troisième image</td>
                                <td>
                                    <input type="file" name="img3" class="form-control d-inline">
                                </td>
                            </tr>
                            <tr scop="row">
                                <td>Quatrième image</td>
                                <td>
                                    <input type="file" name="img4" class="form-control">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="purple-button" data-dismiss="modal">Fermer</button>
          <button type="button" class="green-button" onclick="document.getElementById('create-articl-form').submit();">Ajouter</button>
        </div>
      </div>
    </div>
  </div>






@endsection