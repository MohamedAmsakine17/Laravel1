
@push('css')
<link rel="stylesheet" href="../../../css/articles.css" >
@endpush

@extends('layouts.app')


@section('content')
<main class="main-container">
    <div class="container">

        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Accueil</a></li>
            <li class="breadcrumb-item"><a href="{{route('allarticles',['popular',4])}}">Articles</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ucfirst($category)}}</li>
          </ol>
        </nav>
        <h2 id="{{$category}}" class="category-name">{{ucfirst($category)}}</h2>
        <hr class="mt-5">
        <div class="d-flex justify-content-between">
            <div class="counter-text"><span class="counters">1-{{$n}}</span> de résultats</div>
            <div class="filters-container">
                <div class="dropdown show">
                    <span class="filter-text active-media-off">trier par</span>
                    <button class="btn btn-secondary dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if($filter == 'popular')
                            Populaire
                        @endif
                        @if($filter == 'new')
                            Nouveau
                        @endif
                        @if($filter == 'paid')
                            Payé
                        @endif
                        @if($filter == 'prixH')
                            Prix (élevé à bas)
                        @endif
                        @if($filter == 'prixL')
                            Prix ​​(bas a élevé)
                        @endif
                        @if($filter == 'free')
                            Gratuit
                        @endif
                    </button>
                  
                    <div class="dropdown-menu filter-dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item filter-dropdown-item" href="{{route('articles',[$category,'popular',$n])}}"> Populaire </a>
                      <a class="dropdown-item filter-dropdown-item" href="{{route('articles',[$category,'new',$n])}}"> Nouveau </a>
                      <a class="dropdown-item filter-dropdown-item" href="{{route('articles',[$category,'paid',$n])}}"> Payé </a>
                      <a class="dropdown-item filter-dropdown-item" href="{{route('articles',[$category,'prixH',$n])}}"> Prix (élevé à bas) </a>
                      <a class="dropdown-item filter-dropdown-item" href="{{route('articles',[$category,'prixL',$n])}}"> Prix ​​(bas a élevé) </a>
                      <a class="dropdown-item filter-dropdown-item" href="{{route('articles',[$category,'free',$n])}}"> Gratuit </a>
                    </div>
                  </div>
                <div class="dropdown">
                    <div>
                        <span class="filter-text active-media-off">Voir les résultats</span>
                        <button class="btn btn-secondary dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{$n}}
                        </button>
                      
                        <div class="dropdown-menu filter-dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item filter-dropdown-item" href="{{route('articles',[$category,$filter,4])}}"> 4 </a>
                          <a class="dropdown-item filter-dropdown-item" href="{{route('articles',[$category,$filter,8])}}"> 8 </a>
                          <a class="dropdown-item filter-dropdown-item" href="{{route('articles',[$category,$filter,16])}}"> 16 </a>
                          <a class="dropdown-item filter-dropdown-item" href="{{route('articles',[$category,$filter,32])}}"> 32 </a>
                        </div>
                    </div>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="wrapper">

            @foreach($articles as $article)

            <div class="item">
            <a class="article-link" href="/article/{{$article->id}}">
                <div class="article-card">
                    <div class="article-image-container">
                        <div class="picture" style= "background-image: url({{$article->getFirstMediaUrl('image1', 'thumb')}}); background-repeat: no-repeat; background-size: cover; background-position: center;"></div>
                    </div>
                    <div class="aritcle-text">
                        <div class="article-owner">{{$article->user->name}}</div>
                        <div class="article-title">{{$article->title}}</div>
                        <div class="article-rating">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $article->rating)
                                    <i class="bi bi-star-fill" style="color:#9d44f6;"></i>
                                @else
                                    <i class="bi bi-star"></i>
                                @endif
                            @endfor
                            <span>({{count($article->comments)}})</span>
                        </div>
                        <div class="article-price-container">
                            <div class="d-flex justify-content-between">
                            @if($article->promo < 100 && $article->price > 0 && $article->promo != 0)
                                <div>
                                    <div class="article-promo-price">{{$article->price}} MAD</div>
                                    <div class="article-original-price">{{$article->originalPrice}} MAD</div>
                                </div>
                            @else
                                @if($article->price <= 0)
                                    <div class="article-price">Gratuit</div>
                                @else
                                    <div class="article-price">{{$article->price}} MAD</div>
                                @endif
                            @endif
                            <div>
                                    <form class="d-inline" method="post" action="{{route('ajouterApanier',$article->id)}}">
                                        @csrf
                                        <button type="submit" class="article-add-cart"><i class="bi bi-cart-plus-fill"></i></button>
                                    </form>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            </div>

            @endforeach
        </div>
    </div>
    
    <div class="articles-pages">
        {{ $articles->links() }}
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



</main>
@endsection

@section('scripts')
    
@endsection