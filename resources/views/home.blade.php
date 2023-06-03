
@push('css')
<link rel="stylesheet" href="css/home.css" >
@endpush

@extends('layouts.app')


@section('content')
<main class="main-container">
    <div class="container">



        <div class="row website-header">
            <div class="col-lg-7 col-12 text-lg-start text-center">
                <h2 class="website-header-title">Beaucoup de code, de scripts et de plugins pour chaque création de site Web</h2>
                <p class="website-header-text">Choisissez parmi des plugins de commerce électronique, des modèles d'applications mobiles, PHP, Bootstrap et plus pour tous les budgets, conçus par les meilleurs développeurs.</p>
                <div class="website-header-search">
                    <form method="get" action="{{route('search')}}" class="website-header-from">
                        @csrf
                        <input type="text" class="form-control website-header-input" name="search" placeholder="ex. Plugin de commerce digital" autocomplete="off">
                        <button type="submit" class="website-header-btn purple-button">
                            <span class="material-icons-outlined me-1">
                                search 
                            </span>
                              Recherche
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 col-12">
                <img class="website-header-image" src="{{ url('/images/HeaderImage.png') }}" alt="">
            </div>
        </div>

        <!-- Cards -->

        
        <!--  -->

        <div class="row main-product mb-5 mt-5">
            <div class="col-lg-8 col-12 p-0 main-product-img-container">
                <div class="main-product-img" style="
                    background-image: url({{$firstPinnedArticle->getFirstMediaUrl('image1', 'thumb')}});
                    background-repeat: no-repeat;
                    background-size: cover;
                    background-position: center;
                "></div>
            </div>
            <div class="col-lg-4 col-12 text-light d-flex align-items-center p-4">
                <div class="main-produt-info">
                    <small>{{$firstPinnedArticle->user->name}}</small>
                    <h2 class="main-product-title" >{{$firstPinnedArticle->title}}</h2>
                    <p>{{ \Illuminate\Support\Str::limit($firstPinnedArticle->description, 120) }}</p>
                    <a href="/article/{{$firstPinnedArticle->id}}" class="purple-button">Exposition de produits</a>
                </div>
            </div>
        </div>
        
        <!-- Popular Articles -->

        <div class="mb-5 mt-5">
            <h2>Produits populaires</h2>
            <div >
                <div class="d-flex justify-content-between">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="pills-assets active" id="pills-home-tab" data-toggle="pill" href="#pills-description" role="tab" aria-controls="pills-home" aria-selected="true">Payé</a>
                        </li>
                        <li class="nav-item">
                            <a class="pills-assets" id="pills-profile-tab" data-toggle="pill" href="#pills-reviews" role="tab" aria-controls="pills-profile" aria-selected="false">Gratuit</a>
                        </li>
                    </ul>
                    <div>
                        <a class="link voir-plus-link" href="{{route('allarticles',['popular',4])}}">Voir plus</a>
                    </div>
                </div>
                <hr class="mt-0">
                <div class="tab-content" id="pills-tabContent">
                    <div class="article-cards-container">
                        <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="articles-cards-container">
                                <div class="wrapper">
                                    @foreach($articlesPopulars as $article)
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
                                                        @if($article->promo < 100 && $article->promo != 0)
                                                            <div>
                                                                <div class="article-promo-price">{{$article->price}} MAD</div>
                                                                <div class="article-original-price">{{$article->originalPrice}} MAD</div>
                                                            </div>
                                                        @else
                                                            <div class="article-price">{{$article->price}} MAD</div>
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
                        </div>
                        <div class="tab-pane fade" id="pills-reviews" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="articles-cards-container">
                                <div class="wrapper">
                                    @foreach($articlesPopularsFree as $article)
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
                                                            <div class="article-price">Gratuit</div>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--  -->

        <div class="row main-product mb-5 mt-5">
            <div class="col-lg-4 col-12 text-light d-flex align-items-center p-4">
                <div class="main-produt-info">
                    <small>{{$lastPinnedArticle->user->name}}</small>
                    <h2 class="main-product-title" >{{$lastPinnedArticle->title}}</h2>
                    <p>{{ \Illuminate\Support\Str::limit($lastPinnedArticle->description, 120) }}</p>
                    <a href="/article/{{$firstPinnedArticle->id}}"  class="purple-button">Exposition de produits</a>
                </div>
            </div>
            <div class="col-lg-8 col-12 p-0 main-product-img-container">
                <div class="main-product-img" style="
                    background-image: url({{$lastPinnedArticle->getFirstMediaUrl('image1', 'thumb')}});
                    background-repeat: no-repeat;
                    background-size: cover;
                    background-position: center;
                "></div>
            </div>
        </div>

        <!-- Category Nav -->

        <div class="category-items-container ">
            <div class="categorys">
                <a class="category-item" href="{{route('articles',['php','popular',4])}}">
                    <i class="bi bi-gear"></i>
                    <div>
                        <span>PHP Scripts</span>
                        <small>({{count($articles->where('category','=','php'))}})</small>
                    </div>
                </a>
                <a class="category-item" href="{{route('articles',['plugins','popular',4])}}">
                    <i class="bi bi-braces-asterisk"></i>
                    <div>
                        <span>Plugins</span>
                        <small>({{count($articles->where('category','=','plugins'))}})</small>
                    </div>
                </a>
                <a class="category-item" href="{{route('articles',['ui','popular',4])}}">
                    <i class="bi bi-border-all"></i>
                    <div>
                        <span>Modèles</span>
                        <small>({{count($articles->where('category','=','ui'))}})</small>
                    </div>
                </a>
                <a class="category-item" href="{{route('articles',['app','popular',4])}}">
                    <i class="bi bi-app"></i>
                    <div>
                        <span>APPs</span>
                        <small>({{count($articles->where('category','=','app'))}})</small>
                    </div>
                </a>
                <a class="category-item" href="{{route('articles',['unity','popular',4])}}">
                    <i class="bi bi-unity"></i>
                    <div>
                        <span>UNITY</span>
                        <small>({{count($articles->where('category','=','unity'))}})</small>
                    </div>
                </a>
            </div>
        </div>

        <!-- New Articles -->

        <div class="mb-5 mt-5">
            <div class="d-flex justify-content-between mb-2">
                <h2>Nouveaux articles</h2>
                <a class="link voir-plus-link" href="{{route('allarticles',['new',4])}}">Voir plus</a>
            </div>
            <hr class="mt-0">
            <div class="articles-cards-container">
                
                <div class="wrapper">


                    @foreach($newArticles as $article)
                        <div class="item">
                        <a class="article-link" href="/article/{{$article->id}}">
                            <div class="article-card">
                                <div class="article-image-container">
                                    <div class="picture" style= "background-image: url({{$article->getFirstMediaUrl('image1', 'thumb')}}); background-repeat: no-repeat; background-size: cover; background-position: center;">
                                    </div>
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
        </div>
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
