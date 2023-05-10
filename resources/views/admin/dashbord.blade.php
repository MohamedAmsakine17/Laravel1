@extends('layouts.admin')

@push('css')
    <link rel="stylesheet" href="../../css/admin.css">
@endpush

@section('content')
<main class="dashboard-main">
        <div class="dashboard-container">
            <div class="row h-100 w-100">
                <div class="col-lg-2 dashboard-left-container ">
                    <div class="dashboard-brand">DevMarketplace</div>
                    <hr>
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
                            <li class="mt-4"><a class="option-btn" href="{{route('adminUsers')}}"> <i class="bi bi-people-fill me-2"></i> Utilisateurs</a></li>
                            <li class="mt-4"><a class="option-btn" href="{{route('adminArticles')}}"> <i class="bi bi-shop me-2"></i> Des articles</a></li>
                            <li class="mt-4"><a class="option-btn" href=""> <i class="bi bi-box-arrow-right me-2"></i>Se déconnecter</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-10 dashboard-right-container">

                    <div class="container">
                        <h2 class="mt-4">Tableau de bord</h2>
                        <hr>
                        <div class="dash-container">
                            <div class="statistical">
                                <div class="users-stat stat-cart">
                                    <i class="bi bi-person-bounding-box state-icons"></i>
                                     <p class="state-numbers">{{count($users)}}</p>
                                     <small>Utilisateurs</small>
                                </div>
    
                                <div class="articles-stat stat-cart">
                                    <i class="bi bi-shop-window state-icons"></i>
                                     <p class="state-numbers">{{count($articles)}}</p>
                                     <small>Articles</small>
                                </div>
    
                                <div class="earning-stat stat-cart">
                                    <i class="bi bi-cash-coin state-icons"></i>
                                     <p class="state-numbers">0</p>
                                     <small>Revenus</small>
                                </div>
    
                                <div class="download-stat stat-cart">
                                    <i class="bi bi-cloud-arrow-down state-icons"></i>
                                     <p class="state-numbers">0</p>
                                     <small>Téléchargements</small>
                                </div>
    
                                <div class="comment-stat stat-cart">
                                    <i class="bi bi-person-vcard state-icons"></i>
                                     <p class="state-numbers">0</p>
                                     <small>Commentaires</small>
                                </div>
    
                             </div>
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
    
</main>
@endsection