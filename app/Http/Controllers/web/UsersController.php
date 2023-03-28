<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function profile()
    {
        return view('web.users.profile');
    }
    public function favorites()
    {
        return view('web.users.favorites');
    }
}
