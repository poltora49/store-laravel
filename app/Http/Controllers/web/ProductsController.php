<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        return view('web.products.index');
    }
    public function show()
    {
        return view('web.products.show');
    }
}
