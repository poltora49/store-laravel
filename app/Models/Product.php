<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    use HasFactory;

    public $table = "products";

    protected $fillable = [
        'title',
        'price',
        'description',
        'thumbnail',
        'category_id',
        'hidden',
    ];

    public function getPriceAttribute($value)
    {
        return $value/100;
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value*100;
    }

    public function scopeHidden(Builder $query){
        $query->where('hidden',false);
    }
    public function scopeCategoryName(Builder $builder, $value){
        $builder->whereHas('category', function($q) use ($value) {
            $q->where('category_id', 'like', "%{$value}%");
        });
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
