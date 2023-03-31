<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'price',
        'description',
        'thumbnail',
        'hidden',
        'sorting'
    ];

    public function scopeHidden(Builder $query){
        $query->where('hidden',false)
            ->orderBy('sorting');
    }
    public function carts() {
        return $this->belongsToMany(Cart::class)->withPivot('quantity');
    }
}
