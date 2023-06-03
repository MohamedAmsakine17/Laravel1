
@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="../../css/article.css">
@endpush


@section('content')
<main class="main-container">
      <div class="container">
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
                        <div class="article-owner-picture" style= "background-image: url({{$article->user->getFirstMediaUrl('userImage', 'thumb')}}); background-repeat: no-repeat; background-size: cover; background-position: center;"></div>
                        <small class="article-owner-name">{{$article->user->name}}</small>
                    </div>
                    <div class="article-rating-stars">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $article->rating)
                                <i class="bi bi-star-fill" style="color:#9d44f6;"></i>
                            @else
                                <i class="bi bi-star"></i>
                            @endif
                        @endfor
                        <span>({{count($article->comments)}})</span>
                    </div>
                    <hr>
                    @if($article->promo < 100 && $article->price > 0 && $article->promo != 0)
                        <div class="price promo-price">{{$article->price}} MAD</div> 
                        <div class="d-flex">
                            <div class="original-price">{{$article->originalPrice}} MAD</div> 
                            <div class="promo d-flex align-items-center"><div>{{$article->promo}}%</div></div> 
                        </div>
                    @else
                        @if($article->price <= 0)
                            <div class="price">Gratuit</div>
                        @else
                            <div class="price"> {{$article->price}} MAD</div>
                        @endif
                    @endif
                    <div>
                        <p class="text-secondary">Taxes/TVA calculées à la caisse</p>
                    </div>
                    <div class=" article-buttons">
                        <form class="d-inline" method="post" action="{{route('ajouterApanier',$article->id)}}">
                            @csrf
                            <button type="submit" name="type" value="Buy" class="purple-button article-buy-buttons ">J'ACHETER</button>
                            <button type="submit" class="green-button article-panier-buttons"><i class="bi bi-cart-plus-fill"></i></button>
                        </form>
                        <form class="d-inline" method="post" action="{{route('saveArticle',$article->id)}}">
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
                        <pre class="article-description">{{$article->description}}</pre>
                    </div>
                    <div class="tab-pane fade" id="pills-reviews" role="tabpanel" aria-labelledby="pills-profile-tab">
                    @auth
                        @if($displayComnt)
                        <form class="create-comment-form" action="{{route("comment",$article->id)}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-1 d-lg-block d-none d-flex justify-content-center">
                                    <div class="user-img-comment-container">
                                        <div class="picture"style= "background-image: url({{Auth::user()->getFirstMediaUrl('userImage', 'thumb')}}); background-repeat: no-repeat; background-size: cover; background-position: center;"></div>
                                    </div>
                                </div>
                                <div class="col-lg-11 col-12">
                                    <div class="form-group create-comment-container">
                                        <textarea type="text" class="form-control create-comment-input" name="content" placeholder="Écrire un commentaire"></textarea>
                                        <input type="hidden" name="rating" class="rating-input">
                                        <div class="d-flex"> 
                                            <div class="d-flex">
                                                <i class="bi bi-star rating-star rate-1"></i>
                                                <i class="bi bi-star rating-star rate-2"></i>
                                                <i class="bi bi-star rating-star rate-3"></i>
                                                <i class="bi bi-star rating-star rate-4"></i>
                                                <i class="bi bi-star rating-star rate-5"></i>
                                            </div>
                                            <div class="create-comment-buttons">
                                                <button type="button" class="red-button cancel-comment">Annuler</button>
                                                <button type="submit" class="green-button submit-button" disabled="disabled">Publier</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @endif
                    @endauth
                    <livewire:comments :article="$article">
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <div class="d-flex justify-content-between mb-2">
                    <h2>Articles similaires</h2>
                    <a class="link voir-plus-link" href="{{route('articles',[$article->category,'popular',4])}}">Voir plus</a>
                </div>
                <hr class="mt-0">
                <div class="articles-cards-container">
                    
                    <div class="wrapper">
    
    
                        @foreach($articles as $article)
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
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                            <i class="bi bi-star"></i>
                                            (0)
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

    @section('scripts')
        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
        <script>
           $('.article-img').click(function(){
            $('.main-articl-img').css("background-image",$(this).css("background-image"));
            $('.acitce-article-img').remove()
            $(this).prepend('<div class="acitce-article-img"></div>');
        }) 
        let notSelecting = true;
        let disabled = true;
        let currentStarIndex = 0;
        for(let i = 1;i <= 5 ;i++){
            $(".rate-"+i).hover(function(){
                    $(this).removeClass("bi bi-star");
                    $(this).addClass("bi bi-star-fill");
                    $(this).css("color","#9d44f6");
                    $(this).css('cursor' ,'pointer');
                    for(let j = 1;j<=5;j++){
                        if(i>j){
                            $(".rate-"+j).removeClass("bi bi-star");
                            $(".rate-"+j).addClass("bi bi-star-fill");
                            $(".rate-"+j).css("color","#9d44f6")
                        }
                    }
                    $(this).click(function(){
                        $(".rating-input").val(i);
                        currentStarIndex = i;
                        notSelecting = false;
                        for(let j = 1;j<=5;j++){
                            if(i>j){
                                $(".rate-"+j).removeClass("bi bi-star");
                                $(".rate-"+j).addClass("bi bi-star-fill");
                                $(".rate-"+j).css("color","#9d44f6")
                            }
                        }
                        checkSubmitState();
                    })
                } , function(){
                    for(let j = 1;j<=5;j++){
                            if(currentStarIndex >= j) {continue;}
                            $(".rate-"+j).removeClass("bi bi-star-fill");
                            $(".rate-"+j).addClass("bi bi-star");
                            $(".rate-"+j).css("color","#373c42")
                    }
                }  )
        }


        $(".create-comment-input").on("focus",function(){
            $(".create-comment-container").addClass("create-comment-container-active");
            $(".create-comment-container").removeClass("create-comment-container");
        })

        $(".create-comment-input").on("input",function(){
            if($(this).val().length > 0) {
                disabled = false;
            }
            else {
                disabled = true;
            }
            checkSubmitState();
        })

        $(".cancel-comment").click(function(){
            $(".create-comment-container-active").addClass("create-comment-container");
            $(".create-comment-container").removeClass("create-comment-container-active");
        })
        
       function checkSubmitState() {
            if(disabled == false && notSelecting == false ) {
                    $(".submit-button").removeAttr("disabled");
            } 
                else {
                    $(".submit-button").attr('disabled', 'disabled');
            }
        }

        </script>
    
    @endsection

@endsection

