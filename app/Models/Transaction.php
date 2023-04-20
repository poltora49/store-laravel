<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


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
                'total_price' => Cart::total()*100,
            ]);
    }


    public static function getForUser(){
        return self::where(['user_id'=>auth()->user()->id])->latest()->get();
    }


    public static function total_earning(){
        return self::where('status','paid')->get()->map(function ($item){
            return ($item->total_price);
        })->sum()/100;
    }

    public static function today_count(){
        return count(self::whereDate('created_at',Carbon::today())
            ->where('status','paid')->get());
    }
}
