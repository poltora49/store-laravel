<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    public $table = "favorite";

    protected $fillable =[
        'product_id',
        'user_id',
    ];

    public static function get($user_id){
       return self::where(['user_id'=>$user_id]);
    }

    public static function add($product_id, $user_id){
        $product = Product::findOrFail($product_id);
        $user = User::findOrFail($user_id);
        if(!$product->hidden){
            if(!$favorites= self::where(['user_id' => $user->id, 'product_id' => $product->id])->first()){
                $favorite = self::create([
                    'product_id' => $product->id,
                    'user_id' => $user->id,
                ]);
            }
        }

    }

    public static function remove($product_id){
        $favorite = self::where(['user_id' => auth()->user()->id, 'product_id' => $product_id])->first();
        return self::destroy($favorite->id);
    }

    public static function flush($user_id)  {
        return self::where(['user_id'=>$user_id])->delete();
    }



    public function products() {
        return $this->belongsToMany(Product::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
