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
        'status',
        'session_id',
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }
    public static function add($session){
            $transaction = self::create([
                'user_id' => auth()->user()->id,
                'status' => 'unpaid',
                'session_id' => $session->id,
                'total_price' => Cart::total(),
            ]);
    }
    public static function getForUser(){
        return self::where(['user_id'=>auth()->user()->id])->orderBy('created_at')->get();
    }

}
