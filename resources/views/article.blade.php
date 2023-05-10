{{-- Mohamed Amsakine & Saad El Affati --}}

@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="../../css/article.css">
@endpush


@section('content')
<main class="container py-4">
      <div class="article-container">
            <div class="row">
                <div class="col-lg-7">
                    {{-- //<div class="picture" style= "background-image: url({{$article->img1}});"></div> --}}
                    <div class="article-main-img-container">
                        <div class="article-img main-articl-img" style= "background-image: url({{$article->getFirstMediaUrl('image1', 'thumb')}}); background-repeat: no-repeat; background-size: cover; background-position: center;"></div>
                    </div>
                    <div class="d-flex mt-3">
                        <div class="article-small-img">
                            <div class="article-img" style= "background-image: url({{$article->getFirstMediaUrl('image1', 'thumb')}}); background-repeat: no-repeat; background-size: cover; background-position: center;"><div class="acitce-article-img"></div></div>
                        </div>
                        <div class="article-small-img ms-3 ">
                            <div class="article-img" style= "background-image: url({{$article->getFirstMediaUrl('image2', 'thumb')}}); background-repeat: no-repeat; background-size: cover; background-position: center;"></div>
                        </div>
                        <div class="article-small-img ms-3">
                            <div class="article-img" style= "background-image: url({{$article->getFirstMediaUrl('image3', 'thumb')}}); background-repeat: no-repeat; background-size: cover; background-position: center;"></div>
                        </div>
                        <div class="article-small-img ms-3">
                            <div class="article-img" style= "background-image: url({{$article->getFirstMediaUrl('image4', 'thumb')}}); background-repeat: no-repeat; background-size: cover; background-position: center;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 article-content-container">
                    <h2>{{$article->title}}  </h2>
                    <div class="d-flex align-items-center">
                        <div class="article-owner-picture" style= "background-image: url(/{{$article->user->path}}); background-repeat: no-repeat; background-size: cover; background-position: center;"></div>
                        <small class="article-owner-name">{{$article->user->name}}</small>
                    </div>
                    <div class="article-rating-stars">
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <span>(0)</span>
                    </div>
                    <hr>
                    @if($article->product->promo < 100)
                        <div class="price promo-price">{{$article->product->price}} MAD</div> 
                        <div class="d-flex">
                            <div class="original-price">{{$article->product->originalPrice}} MAD</div> 
                            <div class="promo d-flex align-items-center"><div>{{$article->product->promo}}%</div></div> 
                        </div>
                    @else
                        <div class="price"> {{$article->product->price}} MAD</div>
                    @endif
                    <div class="div article-buttons">
                        <button class="purple-button article-buy-buttons ">J'ACHETER</button>
                        <form class="d-inline" method="post" action="{{route('ajouterApanier',$article->id)}}">
                            @csrf
                            <button type="submit" class="green-button article-panier-buttons"><i class="bi bi-cart-plus-fill"></i></button>
                        </form>
                        <form class="d-inline" method="post" action="{{route('ajouterApanier',$article->id)}}">
                            @csrf
                            <button type="submit" class="red-button article-love-buttons"><i class="bi bi-heart-fill"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="article-about-button active" id="pills-home-tab" data-toggle="pill" href="#pills-description" role="tab" aria-controls="pills-home" aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="article-about-button" id="pills-profile-tab" data-toggle="pill" href="#pills-reviews" role="tab" aria-controls="pills-profile" aria-selected="false">Commentaires</a>
                    </li>
                </ul>
                <hr>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-home-tab">
                        {{$article->description}}
                    </div>
                    <div class="tab-pane fade" id="pills-reviews" role="tabpanel" aria-labelledby="pills-profile-tab">...</div>
                </div>
            </div>
      </div>
</main>

    @section('scripts')
        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
        <script>
           $('.article-img').click(function(){
            $('.main-articl-img').css("background-image",$(this).css("background-image"));
            $('.acitce-article-img').remove()
            $(this).prepend('<div class="acitce-article-img"></div>');
        }) 
        </script>
    
    @endsection

@endsection

