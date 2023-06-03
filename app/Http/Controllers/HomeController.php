<?php

namespace App\Http\Controllers;

use App\Models\Article;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $articles = Article::all();
        $articlesPopulars = Article::where('price', '>', 0)->orderBy('views', 'desc')->take(10)->get();
        $articlesPopularsFree = Article::where('price', '=', 0)->orderBy('views', 'desc')->take(10)->get();
        $newArticles = Article::where('created_at', '>', now()->subDays(30))->take(10)->get();

        $firstPinnedArticle = Article::with('pin')
            ->whereHas('pin')
            ->orderBy('id')
            ->first();

        $lastPinnedArticle = Article::with('pin')
            ->whereHas('pin')
            ->orderBy('id', 'desc')
            ->first();

        return view('home', compact('articlesPopulars', 'newArticles', 'articles', 'articlesPopularsFree', 'firstPinnedArticle', 'lastPinnedArticle'));
    }

    public function articlesByCatg(string $category, string $filter, string $n)
    {
        switch ($filter) {
            case "popular":
                $articles = Article::where('category', '=', $category)->orderBy('views', 'desc')->paginate($n);
                break;
            case "new":
                $articles = Article::where('category', '=', $category)->where('created_at', '>', now()->subDays(30))->paginate($n);
                break;
            case "paid":
                $articles = Article::where('category', '=', $category)->where('price', '>', 0)->paginate($n);
                break;
            case "prixH":
                $articles = Article::where('category', '=', $category)->orderBy('price', 'desc')->paginate($n);
                break;
            case "prixL":
                $articles = Article::where('category', '=', $category)->orderBy('price')->paginate($n);
                break;
            case "free":
                $articles = Article::where('category', '=', $category)->where('price', '<=', 0)->paginate($n);
                break;
        }
        return view('articlesCategory', compact('articles', 'category', 'filter', 'n'));
    }

    public function articles(string $filter, string $n)
    {
        switch ($filter) {
            case "popular":
                $articles = Article::orderBy('views', 'desc')->paginate($n);
                break;
            case "new":
                $articles = Article::where('created_at', '>', now()->subDays(30))->paginate($n);
                break;
            case "paid":
                $articles = Article::where('price', '>', 0)->takepaginate($n);
                break;
            case "prixH":
                $articles = Article::orderBy('price', 'desc')->paginate($n);
                break;
            case "prixL":
                $articles = Article::orderBy('price')->paginate($n);
                break;
            case "free":
                $articles = Article::where('price', '<=', 0)->paginate($n);
                break;
        }
        return view('articles', compact('articles', 'filter', 'n'));
    }

    public function search(Request $request)
    {
        $filter = 'populer';
        $n = 4;
        if (isset($request->search)) {
            $articles = Article::where('title', 'like', '%' . $request->search . '%')->paginate($n);
            return view('articles', compact('articles', 'filter', 'n'));
        }
        return redirect(route('home'));
    }
}