<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Save;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaveController extends Controller
{
    public function index()
    {
        $saves = Auth::user()->saves()->paginate(16);
        return view('saves', compact('saves'));
    }

    public function create(Request $request, $id)
    {
        $user = Auth::user();

        $article = Article::find($id);

        $user->saves()->create([
            'article_id' => $article->id,
        ]);

        return back();
    }

    public function destroy($id)
    {
        Save::find($id)->delete();
        return redirect(route('saves'));
    }

}