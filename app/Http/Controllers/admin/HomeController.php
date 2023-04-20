<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        $months_paids = [];
        for( $i = 0; $i <=12; $i++){
            $months_paids[] = count(Transaction::whereYear('created_at',now()->year)
            ->where('status', 'paid')
            ->whereMonth('created_at', $i)->get());
        }


        $transactions = Transaction::latest()->limit(10)->get();

        return view('Admin.dashboard',[
            'users' => $users,
            'transactions' => $transactions,
            'months_paids' => $months_paids,
        ]);
    }
}
