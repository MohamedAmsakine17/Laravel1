@extends('layouts.admin')

@push('css')
    <link rel="stylesheet" href="../../css/admin.css">
@endpush

@section('content')

        <main class="dashboard-main">
            <div class="dashboard-right-container">
                <div class="container">
                    <div class="dashboard-header">
                        <h2>Articles</h2>
                        
                    </div>
                    <hr>
                    <div class="form-articles-container">
                        <h3 class="form-articles-title">Créer un nouvel article</h3>
                        <!------------------ Form ------------------>
                        <form id="create-articl-form" class="article-form text-dark" method="POST" action="/article" class="mt-3" enctype="multipart/form-data">
                            @csrf
                            <!-- ROW -->
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <!-- File -->
                                    <div class="form-group">
                                        <label for="file">Le produit <span class="required">*</span></label>
                                        <input type="file" name="file" id="file" class="file-input form-input" required>
                                    </div>
                                    <!-- Name -->
                                    <div class="form-group">
                                        <label for="name">Nom de produit <span class="required">*</span></label>
                                        <input type="text" name="name" id="name" class="form-control form-input" value="{{ old('name') }}" placeholder="Entrez le nom de produit" required>
                                    </div>
                                    <!-- Title -->
                                    <div class="form-group"> 
                                        <label for="title">Tite <span class="required">*</span></label>
                                        <input type="text" name="title" id="title" class="form-control form-input" value="{{ old('title') }}" placeholder="Entrez le titre de l'article produit" required>
                                    </div>
                                    <!-- Description -->
                                    <div class="form-group">
                                        <label for="description">Description <span class="required">*</span></label>
                                        <textarea name="description" id="description" class="form-control form-input description-text-area" value=""  placeholder="Entrez la description du produit" required>{{ old('description') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <!-- Category -->
                                    <div class="form-group">
                                        <label for="category">Catégorie <span class="required">*</span></label>
                                        <select name="category" id="category" class="form-select form-input" required>
                                            <option value="{{ old('category') }}" selected disabled hidden>Choisissez la catégorie</option>
                                            <option value="php">PHP Script</option>
                                            <option value="plugins">Plugins</option>
                                            <option value="ui">Modèle</option>
                                            <option value="app">APP</option>
                                            <option value="unity">Unity</option>
                                        </select>
                                    </div>
                                    <!-- Paiment -->
                                    <label>Payement <span class="required">*</span></label>
                                    <div class="article-paiment">
                                        <!-- Free -->
                                        <div class="form-check">
                                            <div class="form-input">
                                                <input class="form-check-input" name="free" type="checkbox" id="free">
                                                <span class="form-check-label" for="free">
                                                    Gratuit
                                                </span>
                                            </div>
                                        </div>
                                        <!-- Price -->
                                        <div>
                                            <label for="price">Prix</label>
                                            <input type="number" name="price" id="price" class="form-control form-input" value="{{ old('price') }}" placeholder="0 DH" min="0"/>
                                        </div>
                                        <!-- Promo -->
                                        <div>
                                            <label for="promo">Promo</label>
                                            <select name="promo" id="promo" class="form-select form-input">
                                                <option value="0" selected>0%</option>
                                                <option value="10">10%</option>
                                                <option value="25">25%</option>
                                                <option value="50">50%</option>
                                                <option value="70">70%</option>
                                                <option value="90">90%</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Images -->
                                    <div class="form-group">
                                        <label>Les images <span class="required">*</span></label>
                                        <div class="form-input">
                                            <div class="row">
                                                <div class="col-lg-6"> <input type="file" name="img1" id="img1"> </div>
                                                <div class="col-lg-6">
                                                    <input type="file" name="img2" id="img2" class=" ">
                                                    <input type="file" name="img3" id="img3" class="images-file">
                                                    <input type="file" name="img4" id="img4" class="images-file">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group d-flex justify-content-between">
                                <a type="button" class="red-button" href="{{route('adminArticles')}}">Retour</a>
                                <button type="submit" class="green-button">Ajouter</button>
                            </div>
                        </form>
                        <!------------------ End Form ------------------>
                    </div>
                </div>
            </div>
            
                <!------------------ Error ------------------>
                <div class="container mt-5">
                    @if ($errors->any())
                      <div class="error-message">
                              @foreach ($errors->all() as $error)
                                  {{ $error }}
                              @endforeach
                      </div>
                    @endif
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
    
    $('#free').click(function(){
        if(this.checked){
            $('#price').attr('disabled','disabled')
            $('#promo').attr('disabled','disabled')
        }
        else{
            $('#price').removeAttr('disabled')
            $('#promo').removeAttr('disabled')
        }
    })


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