<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Article extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'product_id',
        'description',
        'category',
        'price',
        'name',
        'promo',
        'originalPrice',
        'rating'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function saves()
    {
        return $this->hasMany(Save::class);
    }
    public function assets()
    {
        return $this->hasMany(Asset::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function pin()
    {
        return $this->hasOne(Pin::class);
    }
}