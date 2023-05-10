<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = ['price','name','promo','originalPrice'];

    public function article(){
        return $this->hasMany(Article::class);
    }

    public function user(){
        return $this->hasOneThrough(User::class,Article::class);
    }

}