@extends('layouts.admin')

@push('css')
    <link rel="stylesheet" href="../../css/admin.css">
@endpush

@section('content')
<main class="dashboard-main">
                <div class="dashboard-right-container" >
                    <div class="container">
                        <div class="dashboard-header">
                            <h2>Tableau de bord</h2>  
                        </div>
                        <hr>
                        <div class="dash-container">
                            <div class="statistical">
                            <div class="row">
                                <div class="card-container mt-5 col-lg-6">
                                    <div class="card users-card">
                                        <div class="card-header"></div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="card-text">Users</div>
                                                <a href="{{route('adminUsers')}}" class="link">
                                                    <span class="material-icons-outlined card-icon">
                                                        people
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="card-data">
                                                {{count($users)}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-container mt-5 col-lg-6">
                                    <div class="card articles-card">
                                        <div class="card-header"></div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="card-text">Articles</div>
                                                <a href="{{route('adminArticles')}}" class="link">
                                                    <span class="material-icons-outlined card-icon">
                                                        article
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="card-data">
                                                {{count($articles)}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="card-container mt-5 col-lg-6">
                                    <div class="card revenus-card">
                                        <div class="card-header"></div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="card-text">Revenus</div>
                                                <a href="" class="link">
                                                    <span class="material-icons-outlined card-icon">
                                                        paid
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="card-data">
                                                {{$amount}} MAD
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-container mt-5 col-lg-6">
                                    <div class="card downloads-card">
                                        <div class="card-header"></div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="card-text">Téléchargements</div>
                                                <a href="" class="link">
                                                    <span class="material-icons-outlined card-icon">
                                                        file_download
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="card-data">
                                                {{$downloads}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                            </div>   
                            <div class="row">
                                <div class="col-lg-4 col-12 mt-5">
                                    <div class="card card-rank">
                                        <div class="card-header rank-card-header d-flex justify-content-center">
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons-outlined dash-card-icon">
                                                    star_rate
                                                </span>
                                                <span class="dash-card-title">
                                                    Article
                                                </span>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="article-card-image-container">
                                                <div class="picture" style= "background-image: url({{$article_star->getFirstMediaUrl('image1', 'thumb')}}); background-repeat: no-repeat; background-size: cover; background-position: center;"></div>
                                            </div>
                                            <div class="article-card-owner d-flex align-items-center">
                                                <div class="article-card-owner-image-container">
                                                    <div class="picture" style= "background-image: url({{$article_star->user->getFirstMediaUrl('userImage', 'thumb')}}); background-repeat: no-repeat; background-size: cover; background-position: center;"></div>
                                                </div>
                                                <p class="article-card-owner-name">{{$article_star->user->name}}</p>
                                            </div>
                                            <p class="article-card-title">
                                                {{$article_star->title}}
                                            </p>
                                            <div class="d-flex justify-content-between">
                                                <div class="article-card-rating">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= $article_star->rating)
                                                            <i class="bi bi-star-fill" style="color:#9d44f6;"></i>
                                                        @else
                                                            <i class="bi bi-star"></i>
                                                        @endif
                                                    @endfor
                                                    <span>({{count($article_star->comments)}})</span>
                                                </div>
                                                @if($article_star->promo < 100 && $article_star->price > 0 && $article_star->promo != 0)
                                                    <div class="price-data">
                                                        <div class="h4 cart-price">{{$article_star->price}} MAD</div> 
                                                        <div class="d-flex">
                                                            <div class="cart-original-price">{{$article_star->originalPrice}} MAD</div> 
                                                            <div class="promo d-flex align-items-center"><div>{{$article_star->promo}}%</div></div> 
                                                        </div>
                                                    </div>
                                                @else
                                                    @if($article_star->price <= 0)
                                                        <div class="h4 cart-price">Gratuit</div>
                                                    @else
                                                        <div class="h4 cart-price"> {{$article_star->price}} MAD</div>
                                                    @endif
                                                @endif
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-12 mt-5">
                                    <div class="card card-rank">
                                        <div class="card-header rank-card-header d-flex justify-content-center">
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons-outlined dash-card-icon">
                                                    star_rate
                                                </span>
                                                <span class="dash-card-title">
                                                    Vendeur
                                                </span>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="user-cart-img-container">
                                                <div class="picture" style= "background-image: url({{$user_star->getFirstMediaUrl('userImage', 'thumb')}}); background-repeat: no-repeat; background-size: cover; background-position: center;"></div>
                                            </div>
                                            <p class="user-cart-name"> {{$user_star->name}} </p>
                                            <div class="user-info">Articles : <span class="user-info-value">{{count($user_star->articles)}}</span></div>
                                            <div class="user-info">Vend : <span class="user-info-value">{{$userSells}}</span></div>
                                            <div class="user-info">Revenus : <span class="user-info-value">{{$userEarnings}} MAD</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12 mt-5">
                                    <div class="card card-rank">
                                        <div class="card-header rank-card-header d-flex justify-content-center">
                                            <div class="d-flex align-items-center">
                                                <span class="material-icons-outlined dash-card-icon">
                                                    star_rate
                                                </span>
                                                <span class="dash-card-title">
                                                    Client
                                                </span>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="user-cart-img-container">
                                                <div class="picture" style= "background-image: url({{$client_star->getFirstMediaUrl('userImage', 'thumb')}}); background-repeat: no-repeat; background-size: cover; background-position: center;"></div>
                                            </div>
                                            <p class="user-cart-name"> {{$client_star->name}} </p>
                                            <div class="user-info">Il a acheté : <span class="user-info-value">{{count($client_star->assets)}}</span></div>
                                            <div class="user-info">Commentaire : <span class="user-info-value">{{count($client_star->comments)}}</span></div>
                                            <div class="user-info">Dépenser : <span class="user-info-value">{{$client_star->assets_sum_price}} MAD</span></div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 col-12 mt-5 d-md-block d-none">
                                    <div class="card">
                                        <div class="card-header articles-dash-card-header"></div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h3 class="dash-tables-data-title">Produits les plus vendus</h3>
                                                <a href="{{route('adminArticles')}}" class="dash-buttons">Voir tout</a>
                                            </div>
                                            <hr>
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th class="articles-dash-table-th" scope="col">Titre</th>
                                                        <th class="articles-dash-table-th" scope="col">Vendeur</th>
                                                        <th class="articles-dash-table-th" scope="col">Soldes</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($top_articles as $top_article)
                                                    <tr scope="row">
                                                        <td class="article-dash-table-td">{{$top_article->title}}</td>
                                                        <td class="article-dash-table-td">{{$top_article->user->name}}</td>
                                                        <td class="article-dash-table-td">{{$top_article->repetitions}} </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12 mt-5 d-md-block d-none">
                                    <div class="card">
                                        <div class="card-header users-dash-card-header"></div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h3 class="dash-tables-data-title">Client le plus acheteur</h3>
                                                <a href="{{route('adminUsers')}}" class="dash-buttons">Voir tout</a>
                                            </div>

                                            <hr>

                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th class="articles-dash-table-th" scope="col">Client</th>
                                                        <th class="articles-dash-table-th" scope="col">Dépenser</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($top_users as $user)
                                                        <tr scope="row">
                                                            <td class="article-dash-table-td">{{$user->name}}</td>
                                                            <td class="article-dash-table-td">{{$user->assets_sum_price}} MAD</td>
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
                </div>
</main>
@endsection