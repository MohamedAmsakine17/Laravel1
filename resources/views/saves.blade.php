
@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="../css/save.css">
@endpush


@section('content')
<main class="main-container">
    
    <div class="container">
            <!-- current page -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Accueil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Articles enregistrés</li>
                </ol>
            </nav>
            <h2 class="save-page-title">Articles enregistrés</h2>
            <hr class="mt-4 mb-4">
            <!-- Save Item -->
            <div class="d-flex flex-wrap justify-content-center">
                @foreach($saves as $save)
                <div class="save-container me-5 mb-5">
                    <a class="article-link" href="/article/{{$save->article->id}}">
                        <div class="save-image-container">
                            <div class="picture save-article-img" style= "background-image: url({{$save->article->getFirstMediaUrl('image1', 'thumb')}}); background-repeat: no-repeat; background-size: cover; background-position: center;">
                                <div class="remove-save">
                                    <form method="post" action="{{route('deleteSave',$save->id)}}">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit">
                                            <span class="material-icons-outlined">
                                                delete
                                            </span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <p class="save-title m-0">{{$save->article->title}}</p>
                            <div class="d-flex align-items-center mt-2">
                                <div class="save-owner-image">
                                    <div class="picture" style= "background-image: url({{$save->article->user->getFirstMediaUrl('userImage', 'thumb')}}); background-repeat: no-repeat; background-size: cover; background-position: center;"></div>
                                </div>
                                <p class="save-owner m-0">{{$save->article->user->name}}</p>
                            </div>
                            <div class="save-article-rate mt-2">
                                @for($i = 1; $i <= 5; $i++)
                            @if($i <= $save->article->rating)
                                <i class="bi bi-star-fill" style="color:#9d44f6;"></i>
                            @else
                                <i class="bi bi-star"></i>
                            @endif
                        @endfor
                        <span>({{count($save->article->comments)}})</span>
                            </div>
                            <div class="mt-2 d-flex justify-content-between">
                                <div>
                                    @if($save->article->promo < 100 && $save->article->price > 0 && $save->article->promo != 0)
                                    <p class="m-0 save-article-price">{{$save->article->price}} MAD</p>
                                    <div class="d-flex">
                                        <p class="m-0"><s>{{$save->article->originalPrice}} MAD</s></p>
                                        <div class="promo">{{$save->article->promo}}%</div>
                                    </div>
                                    @else
                                        @if($save->article->price <= 0)
                                            <p class="m-0 save-article-price">Gratuit</p>
                                        @else
                                            <p class="m-0 save-article-price">{{$save->article->price}} MAD</p>
                                        @endif
                                    @endif
                                </div>
                                <div>
                                    <form class="d-inline" method="post" action="{{route('ajouterApanier',$save->article->id)}}">
                                        @csrf
                                        <button type="submit" class="article-add-cart"><i class="bi bi-cart-plus-fill"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
    </div>

    <div class="articles-pages">
        {{ $saves->links() }}
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

