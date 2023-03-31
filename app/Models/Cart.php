<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable =[
        'session_id',
        'product_id',
        'price',
        'quantity'
    ];

    public static function get(){
       return self::where(['session_id'=>session()->getId()])->get();
    }

    public static function count(){
        return self::where(['session_id'=>session()->getId()])->sum('quantity');
    }


    public static function add($product_id){
        $product = Product::findOrFail($product_id);

        if($cart= self::where(['session_id' => session()->getId(), 'product_id' => $product->id])->first()){
            $cart->quantity++;
            $cart->save();
        }
        else{
            $cart = self::create([
                'session_id' => session()->getId(),
                'product_id' => $product->price,
                'price' => $product->price,
                'quantity' => 1
            ]);
        }
    }


    public static function quantity($id,$quantity)  {
        if($quantity<=0){
            return self::remove($id);
        }
        $cart = self::findOrFail($id);

        $cart->quantity = $quantity;
        $cart->save();

        return $cart;
    }


    public static function remove($id){
        return self::destroy($id);
    }


    public static function flush()  {
        return self::where(['session_id'=>session()->getId()])->delete();
    }


    public static function total()  {
        return self::where(['session_id'=>session()->getId()])->get()->map(function ($item){
            return $item->price*$item->quantity;
        })->sum();
    }
    public function products() {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
}
