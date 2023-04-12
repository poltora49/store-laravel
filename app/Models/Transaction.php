<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public $table = "transactions";


    protected $fillable = [
        'total_price',
        'user_id',
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }
    public static function add(){
        // if(auth()->check()){
            $transaction = self::create([
                'user_id' => auth()->user()->id,
                'total_price' => Cart::total(),
            ]);
            $transaction = self::create([
                'user_id' => 1,
                'total_price' => 1,
            ]);
        // }
    }
    public static function getForUser(){
        return self::where(['user_id'=>auth()->user()->id])->orderBy('created_at')->get();
    }

}
