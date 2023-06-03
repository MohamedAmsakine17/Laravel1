<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function index()
    {
        $carts = Auth::user()->carts()->paginate(3);
        $cartsTotal = Auth::user()->carts;
        $priceTotal = 0;
        foreach ($cartsTotal as $cart) {
            $priceTotal += $cart->price;
        }
        return view('cart', compact('carts', 'priceTotal'));
    }
    public function create(Request $request, $id)
    {
        $user = Auth::user();

        $article = Article::find($id);

        $user->carts()->create([
            'title' => $article->title,
            'price' => $article->price,
            'article_id' => $article->id
        ]);
        if ($request->type == "Buy") {
            return redirect(route('panier'));
        } else {
            return back();
        }
    }

    public function destroy($id)
    {
        Cart::find($id)->delete();
        return redirect(route('panier'));
    }
}