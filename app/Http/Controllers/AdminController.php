<?php

namespace App\Http\Controllers;

use AmrShawky\LaravelCurrency\Facade\Currency;


use App\Models\Product;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payment;
use App\Models\Asset;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $articles = Article::all();
        $payments = Payment::all();
        $assets = Asset::all();

        $amount = Asset::sum('price');
        $downloads = 0;

        foreach ($articles as $article) {
            $downloads += $article->downloads;
        }

        $userArticles = Article::select('user_id', \DB::raw('COUNT(user_id) as count'))
            ->groupBy('user_id')
            ->orderByDesc('count')
            ->first();

        $user_star = User::find($userArticles->user_id);


        $client_star = User::withSum('assets', 'price')
            ->orderBy('assets_sum_price', 'desc')
            ->first();
        ;

        $article_star = Article::orderBy("views", "desc")->first();

        $userSells = 0;
        $userEarnings = 0;
        foreach ($assets as $asset) {
            foreach ($user_star->articles as $article) {
                if ($asset->article_id == $article->id) {
                    $userSells++;
                    $userEarnings += $asset->price;
                }
            }
        }

        $top_articles = Article::select('articles.*')
            ->selectSub(function ($query) {
                $query->selectRaw('COUNT(assets.article_id)')
                    ->from('assets')
                    ->whereColumn('assets.article_id', 'articles.id');
            }, 'repetitions')
            ->orderBy('repetitions', 'desc')
            ->take(5)
            ->get();

        $top_users = User::withCount('assets')
            ->withSum('assets', 'price')
            ->orderBy('assets_count', 'desc')
            ->take(5)
            ->get();



        return view('admin.dashbord', compact('users', 'articles', 'amount', 'downloads', 'article_star', 'user_star', 'userSells', 'userEarnings', 'client_star', 'top_articles', 'top_users'));
    }

    public function users()
    {
        return view('admin.users');
    }

    public function trash()
    {
        return view('admin.deletes');
    }



    public function destroyUser(string $id)
    {
        User::find($id)->delete();
        return redirect(route('adminUsers'));
    }

    public function articles()
    {
        $articles = Article::with('pin')->paginate(5);
        return view('admin.articles', compact('articles'));
    }
}