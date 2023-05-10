{{-- Mohamed Amsakine & Saad El Affati --}}

@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="../../css/cart.css">
@endpush


@section('content')
<main class="container main-container">
    <div class="row">
        <div class="col-lg-9 col-12">
            <div class="carts-container">
                <h2>Panier ({{count($carts)}})</h2>
                <hr>
                @foreach($carts as $cart)
                    <div class="d-flex">
                        <div class="cart-img-container">
                            <div class="cart-img" style= "background-image: url({{$cart->article->getFirstMediaUrl('image3', 'thumb')}}); background-repeat: no-repeat; background-size: cover; background-position: center;"></div>
                        </div>
                        <div class="d-flex justify-content-between w-100 cart-text-data">
                            <a class="h4 cart-title" href="/article/{{$cart->article->id}}"><span>{{$cart->title}}</span></a>
                           <div>
                            @if($cart->article->product->promo < 100)
                                <div class="price-data">
                                    <div class="h4 cart-price">{{$cart->article->product->price}} MAD</div> 
                                    <div class="d-flex">
                                        <div class="cart-original-price">{{$cart->article->product->originalPrice}} MAD</div> 
                                        <div class="promo d-flex align-items-center"><div>{{$cart->article->product->promo}}%</div></div> 
                                    </div>
                                </div>
                            @else
                                <div class="price-data">
                                    <div class="h4 cart-price"> {{$cart->article->product->originalPrice}} MAD</div>
                                </div>
                            @endif
                           </div>
                        </div>
                    </div>
                    <form class="mt-4" method="post" action="{{route('deleteCart',$cart->id)}}">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="red-button cart-delete-button"> <i class="bi bi-trash me-1"></i> Supprimer</button>
                    </form>
                    <hr>
                @endforeach
            </div>
        </div>
        <div class="col-lg-3 col-12">
            <div class="counter-container">
                <h3>RÉSUMÉ DU PANIER</h3>
                <hr>
                <div class="d-flex justify-content-between counter-info">
                    <p>Sous-total</p>
                    <p>{{$priceTotal}} MAD</p>
                </div>
            </div>
            <button class="purple-button cart-buy-buttons">J'ACHETER</button>
        </div>
    </div>
</main>
@endsection

