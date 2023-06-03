<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class CommentController extends Controller
{


    public function create(Request $request, $id)
    {

        $user = Auth::user();


        $article = Article::find($id);


        if ($user->comments()->count() > 0) {
            foreach ($user->comments as $comment) {
                if ($comment->article_id == $article->id) {
                    $comment->delete();
                }
            }
        }

        $user->comments()->create([
            'article_id' => $article->id,
            'content' => $request->content,
            'rating' => $request->rating,
        ]);

        
        $article->update([
            "rating" => $article->comments->sum("rating") / $article->comments->count("rating")
        ]);


        return redirect("/article/" . $article->id);
    }

    public function destroy($id)
    {
        Comment::find($id)->delete();
        return back();
    }
}