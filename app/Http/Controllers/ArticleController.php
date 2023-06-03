<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Cart;
use App\Models\TemporaryFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect(route('adminArticles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.article.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $data = $request->all();

        if (isset($request->free)) {
            if ($data['free'] == 'on') {
                $data['promo'] = 0;
                $data['price'] = 0;
            }
        }

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'category' => ['required'],
            'file' => ['required'],
            'img1' => ['required'],
            'img2' => ['required'],
            'img3' => ['required'],
            'img4' => ['required'],
        ]);

        $article = $user->articles()->create([
            'title' => $data['title'],
            'description' => $data['description'],
            'category' => $data['category'],
            'name' => $data['name'],
            'originalPrice' => $data['price'],
            'promo' => $data['promo'],
            'price' => $data['price'] - ($data['price'] * $data['promo']) / 100
        ]);




        $temprorayfile = TemporaryFiles::where('folder', $request->file)->first();
        if ($temprorayfile) {
            $data['file'] = storage_path('app/files/tmp/' . $request->file . '/' . $temprorayfile->filename);
            $article->addMedia(storage_path('app/files/tmp/' . $request->file . '/' . $temprorayfile->filename))->toMediaCollection('file');
            File::deletedirectory(storage_path('app/files/tmp/' . $request->file));
            $temprorayfile->delete();
        }
        $temprorayfile = TemporaryFiles::where('folder', $request->img1)->first();
        if ($temprorayfile) {
            $data['img1'] = storage_path('app/files/tmp/' . $request->img1 . '/' . $temprorayfile->filename);
            $article->addMedia(storage_path('app/files/tmp/' . $request->img1 . '/' . $temprorayfile->filename))->toMediaCollection('image1');
            File::deletedirectory(storage_path('app/files/tmp/' . $request->img1));
            $temprorayfile->delete();
        }
        $temprorayfile = TemporaryFiles::where('folder', $request->img2)->first();
        if ($temprorayfile) {
            $data['img2'] = storage_path('app/files/tmp/' . $request->img2 . '/' . $temprorayfile->filename);
            $article->addMedia(storage_path('app/files/tmp/' . $request->img2 . '/' . $temprorayfile->filename))->toMediaCollection('image2');
            File::deletedirectory(storage_path('app/files/tmp/' . $request->img2));
            $temprorayfile->delete();
        }
        $temprorayfile = TemporaryFiles::where('folder', $request->img3)->first();
        if ($temprorayfile) {
            $data['img3'] = storage_path('app/files/tmp/' . $request->img3 . '/' . $temprorayfile->filename);
            $article->addMedia(storage_path('app/files/tmp/' . $request->img3 . '/' . $temprorayfile->filename))->toMediaCollection('image3');
            File::deletedirectory(storage_path('app/files/tmp/' . $request->img3));
            $temprorayfile->delete();
        }
        $temprorayfile = TemporaryFiles::where('folder', $request->img4)->first();
        if ($temprorayfile) {
            $data['img4'] = storage_path('app/files/tmp/' . $request->img4 . '/' . $temprorayfile->filename);
            $article->addMedia(storage_path('app/files/tmp/' . $request->img4 . '/' . $temprorayfile->filename))->toMediaCollection('image4');
            File::deletedirectory(storage_path('app/files/tmp/' . $request->img4));
            $temprorayfile->delete();
        }

        return redirect(route('adminArticles'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::find($id);
        $article->views = $article->views + 1;
        $article->save();
        $articles = Article::where('category', '=', $article->category)->where('id', '!=', $article->id)->paginate(5);

        $displayComnt = false;
        foreach (Auth::user()->assets as $asset) {
            if ($asset->article->id == $article->id) {
                $displayComnt = true;
            }
        }


        return view('article', compact('article', 'articles', 'displayComnt'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = Article::find($id);
        return view('admin.article.update', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'category' => ['required'],
        ]);

        $data = $request->all();

        if (isset($request->free)) {
            if ($data['free'] == 'on') {
                $data['promo'] = 0;
                $data['price'] = 0;
            }
        }

        $article = Article::find($id);

        $article->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'category' => $data['category'],
            'name' => $data['name'],
            'originalPrice' => $data['price'],
            'promo' => $data['promo'],
            'price' => $data['price'] - ($data['price'] * $data['promo']) / 100
        ]);


        $temprorayfile = TemporaryFiles::where('folder', $request->file)->first();
        if ($temprorayfile) {
            $data['file'] = storage_path('app/files/tmp/' . $request->file . '/' . $temprorayfile->filename);
            $article->addMedia(storage_path('app/files/tmp/' . $request->file . '/' . $temprorayfile->filename))->toMediaCollection('file');
            File::deletedirectory(storage_path('app/files/tmp/' . $request->file));
            $temprorayfile->delete();
        }
        $temprorayfile = TemporaryFiles::where('folder', $request->img1)->first();
        if ($temprorayfile) {
            $data['img1'] = storage_path('app/files/tmp/' . $request->img1 . '/' . $temprorayfile->filename);
            $article->addMedia(storage_path('app/files/tmp/' . $request->img1 . '/' . $temprorayfile->filename))->toMediaCollection('image1');
            File::deletedirectory(storage_path('app/files/tmp/' . $request->img1));
            $temprorayfile->delete();
        }
        $temprorayfile = TemporaryFiles::where('folder', $request->img2)->first();
        if ($temprorayfile) {
            $data['img2'] = storage_path('app/files/tmp/' . $request->img2 . '/' . $temprorayfile->filename);
            $article->addMedia(storage_path('app/files/tmp/' . $request->img2 . '/' . $temprorayfile->filename))->toMediaCollection('image2');
            File::deletedirectory(storage_path('app/files/tmp/' . $request->img2));
            $temprorayfile->delete();
        }
        $temprorayfile = TemporaryFiles::where('folder', $request->img3)->first();
        if ($temprorayfile) {
            $data['img3'] = storage_path('app/files/tmp/' . $request->img3 . '/' . $temprorayfile->filename);
            $article->addMedia(storage_path('app/files/tmp/' . $request->img3 . '/' . $temprorayfile->filename))->toMediaCollection('image3');
            File::deletedirectory(storage_path('app/files/tmp/' . $request->img3));
            $temprorayfile->delete();
        }
        $temprorayfile = TemporaryFiles::where('folder', $request->img4)->first();
        if ($temprorayfile) {
            $data['img4'] = storage_path('app/files/tmp/' . $request->img4 . '/' . $temprorayfile->filename);
            $article->addMedia(storage_path('app/files/tmp/' . $request->img4 . '/' . $temprorayfile->filename))->toMediaCollection('image4');
            File::deletedirectory(storage_path('app/files/tmp/' . $request->img4));
            $temprorayfile->delete();
        }

        return redirect(route('adminArticles'));
    }


    public function filter()
    {

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::find($id);
        Cart::where('article_id', '=', $id)->delete();
        $article->delete();
        return redirect(route('adminArticles'));
    }

}