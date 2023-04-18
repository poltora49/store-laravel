<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class PaymentsController extends Controller
{
    public function transaction(){
        $transactions = Transaction::query()->get();
        return view('Admin.transactions',[
            'transactions' => $transactions,
        ]);
    }
}
