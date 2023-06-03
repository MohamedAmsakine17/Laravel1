<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssetController extends Controller
{
    public function index()
    {
        $n = 4;
        $category = 'all';
        $assets = Auth::user()->assets()->paginate($n);
        return view('assets', compact('assets', 'n', 'category'));
    }

    public function filter($category, $n)
    {
        if ($category == "all") {
            $assets = Auth::user()->assets()->paginate($n);
        } else {
            $assets = Auth::user()->assets()->where('category', '=', $category)->paginate($n);
        }

        return view('assets', compact('assets', 'category', 'n'));
    }
}