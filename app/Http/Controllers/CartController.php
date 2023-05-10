<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function index(){
        $user = Auth::user();
        $carts = $user->carts;
        $priceTotal = 0;
        foreach($carts as $cart){
            $priceTotal += $cart->price;
        }
        return view('cart',compact('carts','priceTotal'));
    }
    public function create($id){
        $user = Auth::user();

        $article = Article::find($id);

        $cart = $user->carts()->create([
            'title' => $article->title,
            'price' =>$article->product->price,
            'article_id' => $article->id
        ]);

        return redirect(route('panier'));
    }

    public function destroy($id){
        Cart::find($id)->delete();
        return redirect(route('panier'));
    }
}
