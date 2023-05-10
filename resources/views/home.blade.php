{{-- Mohamed Amsakine & Saad El Affati --}}

@push('css')
<link rel="stylesheet" href="css/home.css" >
@endpush

@extends('layouts.app')


@section('content')
<main class="main-container">
    <div class="container">
        <div class="row main-product">
            <div class="col-lg-8 col-12 p-0 main-product-img-container">
                <div class="main-product-img" style="
                    background-image: url({{url('/images/test-img.jpg')}});
                    background-repeat: no-repeat;
                    background-size: cover;
                    background-position: center;
                "></div>
            </div>
            <div class="col-lg-4 col-12 text-light d-flex align-items-center p-4">
                <div class="main-produt-info">
                    <small>AMÉLIOREZ VOTRE DÉVELOPPEMENT</small>
                    <h2 class="main-product-title" >Asset Title</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam aut in velit asperiores, error molestiae.</p>
                    <button class="purple-button">ACHETER</button>
                </div>
            </div>
        </div>
        <div class="category-items-container">
            <div class="d-flex justify-content-around align-items-center">
                <a class="category-item">
                    <i class="bi bi-gear"></i>
                    <div>
                        <span>API</span>
                        <small>(30)</small>
                    </div>
                </a>
                <a class="category-item">
                    <i class="bi bi-braces-asterisk"></i>
                    <div>
                        <span>Framworks</span>
                        <small>(15)</small>
                    </div>
                </a>
                <a class="category-item">
                    <i class="bi bi-border-all"></i>
                    <div>
                        <span>UI</span>
                        <small>(30)</small>
                    </div>
                </a>
                <a class="category-item">
                    <i class="bi bi-app"></i>
                    <div>
                        <span>APPs</span>
                        <small>(30)</small>
                    </div>
                </a>
                <a class="category-item">
                    <i class="bi bi-unity"></i>
                    <div>
                        <span>UNITY</span>
                        <small>(30)</small>
                    </div>
                </a>
            </div>
        </div>
        <div>
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
                        <a class="link voir-plus-link" href="">Voir plus</a>
                    </div>
                </div>
                <hr class="mt-0">
                <div class="tab-content" id="pills-tabContent">
                    <div class="article-cards-container">
                        <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="articles-cards-container">
                                <div class="wrapper">
                                    <div class="item">
                                        <div class="article-card">
                                            <div class="article-image"></div>
                                            <div class="aritcle-text">
                                                <div class="article-owner">Mohamed amsakine</div>
                                                <div class="article-title">ChatGPT Appliaction new hahaha</div>
                                                <div class="article-rating">
                                                    <i class="bi bi-star"></i>
                                                    <i class="bi bi-star"></i>
                                                    <i class="bi bi-star"></i>
                                                    <i class="bi bi-star"></i>
                                                    <i class="bi bi-star"></i>
                                                    (0)
                                                </div>
                                                <div class="article-price-container">
                                                    <div class="article-price">50 MAD</div>
                                                    <div></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-reviews" role="tabpanel" aria-labelledby="pills-profile-tab">
                            Free Items
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5">
            <div class="d-flex justify-content-between mb-2">
                <h2>Nouveaux articles</h2>
                <a class="link voir-plus-link" href="">Voir plus</a>
            </div>
            <hr class="mt-0">
            <div class="articles-cards-container">
                <div class="wrapper">
                    <div class="item">
                        <div class="article-card">
                            <div class="article-image"></div>
                            <div class="aritcle-text">
                                <div class="article-owner">Mohamed amsakine</div>
                                <div class="article-title">ChatGPT Appliaction new hahaha</div>
                                <div class="article-rating">
                                    <i class="bi bi-star"></i>
                                    <i class="bi bi-star"></i>
                                    <i class="bi bi-star"></i>
                                    <i class="bi bi-star"></i>
                                    <i class="bi bi-star"></i>
                                    (0)
                                </div>
                                <div class="article-price-container">
                                    <div class="article-price">50 MAD</div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5">
        <hr class="m-0">
        <div class="container">
            <div class="row about-web-site-text">
                <div class="d-flex col-lg-4 col-12">
                    <i class="bi bi-patch-check"></i>
                    <div>
                        <span>
                            Produits de qualité
                        </span>
                        <small>
                            plus de 10 produits cinq étoiles
                        </small>
                    </div>
                </div>
    
                <div class="d-flex col-lg-4 col-12">
                    <i class="bi bi-heart"></i>
                    <div>
                        <span>
                            De confiance
                        </span>
                        <small>
                            évalué par 50 000 clients
                        </small>
                    </div>
                </div>

                <div class="d-flex col-lg-4 col-12">
                    <i class="bi bi-globe-europe-africa"></i>
                    <div>
                        <span>
                            Soutien communautaire
                        </span>
                        <small>
                            soutenu par 3 membres du forum
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')
    
@endsection