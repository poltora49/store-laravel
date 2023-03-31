<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    use HasFactory;

    protected $fillable =[
        'title',
        'thumbnail',
        'hidden',
        'sorting'
    ];

    public function scopeHidden(Builder $query){
        $query->where('hidden',false)
            ->orderBy('sorting');
    }

    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
