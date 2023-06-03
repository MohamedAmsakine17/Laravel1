<?php

namespace App\Http\Controllers;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Models\Article;
use Illuminate\Http\Request;

class DownloadMediaController extends Controller
{
    public function show($id)
    {
        $asset = Article::find($id)->getFirstMedia('file');
        Article::whereId($id)->update(["downloads" => Article::find($id)->downloads + 1]);
        return response()->download($asset->getPath(), $asset->file_name);
    }
}