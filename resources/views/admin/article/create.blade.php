@extends('layouts.admin')

@push('css')
    <link rel="stylesheet" href="../../css/admin.css">
    <style>
        body{
            height: auto;
        }
    </style>
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
            <div class="col-lg-10 h-100 dashboard-right-container">
                <div class="container">
                    <form id="create-articl-form" class="article-form text-dark" method="POST" action="/article" class="mt-3" enctype="multipart/form-data">
                        @csrf
                        <span class="form-articl-icon"><i class="bi bi-cloud-arrow-up"></i></span>
                        <div class="form-group">
                            <input type="file" name="file" id="file">
                        </div>
                        <div class="form-group">
                            <label for="name">Nom de produit</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="Entrez le nom de produit">
                        </div>
                        <div class="form-group"> 
                            <label for="title">Tite</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" placeholder="Entrez le titre de l'article produit">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" value="{{ old('description') }}"  placeholder="Entrez la description du produit"></textarea>
                        <div class="form-group">
                            <label for="category">Catégorie</label>
                            <select name="category" id="category" class="form-select">
                                <option value="{{ old('category') }}" selected disabled hidden>Choisissez la catégorie</option>
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
                                <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}" placeholder="0 DH" min="0"/>
                            </div>
                            <div class="ms-2">
                                <label for="promo">Promo</label>
                                <select name="promo" id="promo" class="form-select">
                                    <option value="{{ old('promo') }}"  selected disabled hidden>Choisissez le promo</option>
                                    <option value="100">0%</option>
                                    <option value="10">10%</option>
                                    <option value="25">25%</option>
                                    <option value="50">50%</option>
                                    <option value="70">70%</option>
                                    <option value="90">90%</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-groupd">
                            <label class="mb-2">Les images</label>
                            <div class="row">
                                <div class="col-lg-6"><input type="file" name="img1" id="img1"></div>
                                <div class="col-lg-6"><input type="file" name="img2" id="img2"></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6"><input type="file" name="img3" id="img3"></div>
                                <div class="col-lg-6"><input type="file" name="img4" id="img4"></div>
                            </div>
                        </div>
                        <div class="form-group d-flex justify-content-between">
                            <a type="button" class="red-button" href="{{route('adminArticles')}}">Retour</a>
                            <button type="submit" class="green-button">Ajouter</button>
                        </div>
                    </form>
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
            </div>
        </div>  
    </div>
</main>

@section('scripts')
<script>

    // get a reference to the fieldset element
    const fieldsetElement = document.querySelector('#file');
    const img1 = document.querySelector('#img1');
    const img2 = document.querySelector('#img2');
    const img3 = document.querySelector('#img3');
    const img4 = document.querySelector('#img4');

    // create a FilePond instance at the fieldset element location
    const pond = FilePond.create(fieldsetElement);
    const pond1 = FilePond.create(img1, {
    // Only accept images
    acceptedFileTypes: ['image/*'],
    });
    const pond2 = FilePond.create(img2, {
    // Only accept images
    acceptedFileTypes: ['image/*'],
    });
    const pond3 = FilePond.create(img3, {
    // Only accept images
    acceptedFileTypes: ['image/*'],
    });
    const pond4 = FilePond.create(img4, {
    // Only accept images
    acceptedFileTypes: ['image/*'],
    });

    FilePond.setOptions({
        labelIdle: 'Glisser & déposez vos fichiers ou <span class="filepond--label-action"> Parcourez </span>',
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





{{-- 
    
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
-----------------------------------

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
                                
                            </div>
                            
                        </form>
    
    
    
    
    
    --}}