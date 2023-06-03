@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="css/asset.css" >    
    <link rel="stylesheet" href="../../css/asset.css" >    
@endpush



@section('content')
<main class="main-container">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Actifs</li>
            </ol>
        </nav>
        <div class="assets-header">
            <h2 class="assets-main-title">Mon Actifs</h2>
            <div class="filters-container">
                <div class="dropdown d-lg-block d-none">
                    <div>
                        <span class="filter-text active-media-off">Les Catégorie</span>
                        <button class="btn btn-secondary dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if($category == 'php')
                                PHP Scripts
                            
                            @elseif($category == 'plugins')
                                Plugins
                            
                            @elseif($category == 'ui')
                                Modèles
                            
                            @elseif($category == 'app')
                                APPs
                            
                            @elseif($category == 'unity')
                                Unity
                            @else
                                Toutes catégories
                            @endif
                            
                        </button>
                      
                        <div class="dropdown-menu filter-dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item filter-dropdown-item" href="{{route('filter_assets',['all',$n])}}"> Toutes catégories </a>
                            <a class="dropdown-item filter-dropdown-item" href="{{route('filter_assets',['php',$n])}}"> PHP Scripts </a>
                            <a class="dropdown-item filter-dropdown-item" href="{{route('filter_assets',['plugins',$n])}}"> Plugins </a>
                            <a class="dropdown-item filter-dropdown-item" href="{{route('filter_assets',['ui',$n])}}"> Modèles </a>
                            <a class="dropdown-item filter-dropdown-item" href="{{route('filter_assets',['app',$n])}}"> APPs </a>
                            <a class="dropdown-item filter-dropdown-item" href="{{route('filter_assets',['unity',$n])}}"> Unity </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="mt-4 mb-4">
        <div class="asset-pages-filter">
            <div class="counter-text"><span class="counters">1-4</span> de résultats</div>
            <div class="filters-container">
                <div class="dropdown">
                    <div>
                        <span class="filter-text active-media-off">Voir les résultats</span>
                        <button class="btn btn-secondary dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{$n}}
                        </button>
                      
                        <div class="dropdown-menu filter-dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item filter-dropdown-item" href="{{route('filter_assets',[$category,4])}}"> 4 </a>
                            <a class="dropdown-item filter-dropdown-item" href="{{route('filter_assets',[$category,8])}}"> 8 </a>
                            <a class="dropdown-item filter-dropdown-item" href="{{route('filter_assets',[$category,16])}}"> 16 </a>
                            <a class="dropdown-item filter-dropdown-item" href="{{route('filter_assets',[$category,32])}}"> 32 </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="mt-4 mb-4">
        <!-- Assets Container -->
        <div class="assets-container">
    
                @foreach($assets as $asset)
                <div class="asset">
                    <div class="row">
                        <div class="col-lg-5">
                            <a class="article-link d-flex" href="/article/{{$asset->article->id}}">
                            <div class="asset-img-container me-2">
                                <div class="picture" style= "background-image: url({{$asset->article->getFirstMediaUrl('image1', 'thumb')}}); background-repeat: no-repeat; background-size: cover; background-position: center;"></div>
                            </div>
                            <div class="asset-article-info">
                                <div class="asset-article-owner">
                                    {{$asset->article->user->name}}
                                </div>
                                <div class="asset-article-title">
                                    {{$asset->article->title}}
                                </div>
                                <div class="asset-article-size">
                                    {{$asset->article->getFirstMedia('file')->human_readable_size}}
                                </div>
                                <div class="asset-article-buy-date">
                                    <b>Date d'achat</b>: {{date('F d Y', strtotime($asset->created_at))}}
                                </div>
                            </div>
                            </a>
                        </div>
                        <div class="col-lg-5">
                            <div class="asset-article-update-date">
                                <b>Date de mise à jour</b>: {{date('F d Y', strtotime($asset->article->updated_at))}}
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <a class="button" type="button" href="{{route('download',$asset->article->id)}}">
                                <span class="button__text">Download</span>
                                <span class="button__icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 35 35" id="bdd05811-e15d-428c-bb53-8661459f9307" data-name="Layer 2" class="svg"><path d="M17.5,22.131a1.249,1.249,0,0,1-1.25-1.25V2.187a1.25,1.25,0,0,1,2.5,0V20.881A1.25,1.25,0,0,1,17.5,22.131Z"></path><path d="M17.5,22.693a3.189,3.189,0,0,1-2.262-.936L8.487,15.006a1.249,1.249,0,0,1,1.767-1.767l6.751,6.751a.7.7,0,0,0,.99,0l6.751-6.751a1.25,1.25,0,0,1,1.768,1.767l-6.752,6.751A3.191,3.191,0,0,1,17.5,22.693Z"></path><path d="M31.436,34.063H3.564A3.318,3.318,0,0,1,.25,30.749V22.011a1.25,1.25,0,0,1,2.5,0v8.738a.815.815,0,0,0,.814.814H31.436a.815.815,0,0,0,.814-.814V22.011a1.25,1.25,0,1,1,2.5,0v8.738A3.318,3.318,0,0,1,31.436,34.063Z"></path></svg></span>
                            </a>
                        </div>
                    </div>
                    <hr class="mt-4 mb-4">
                </div>
                @endforeach
               
            <div class="articles-pages">
                {{ $assets->links() }}
            </div>
            
        

        </div>
        <!-- ! Assets Container -->
    </div>
</main>    
@section('scripts')
<script>
    
</script>
@endsection
@endsection