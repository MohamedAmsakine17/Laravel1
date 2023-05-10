<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index(){
        $users = User::all();
        $articles = Article::all();
        return view('admin.dashbord',compact('users','articles'));
    }

    public function users(){
        $users = User::all();
        return view('admin.users',compact('users'));
    }

    public function destroyUser(string $id)
    {
        User::find($id)->delete();
        return redirect(route('adminUsers'));
    }

    public function articles(){
        $articles = Article::all();
        return view('admin.articles',compact('articles'));
    }
}