<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pin;
use App\Models\Article;

class PinController extends Controller
{
    public function create($id)
    {
        $pinsCount = Pin::count();
        if ($pinsCount >= 2) {
            // Get the oldest article
            $oldestPin = Pin::orderBy('created_at')->first();

            // Delete the oldest article
            $oldestPin->delete();
        }
        Pin::create(["article_id" => $id]);
        return back();
    }
}