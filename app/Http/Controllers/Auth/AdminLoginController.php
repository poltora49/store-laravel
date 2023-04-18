<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers as AuthenticatesUsers;
use \Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\LoginAdminForm;


class AdminLoginController extends Controller
{
    use AuthenticatesUsers;

      protected $redirectTo = '/admin';
      /**
       * Where to redirect users after login.
       *
       * @var string
       */
      public function __construct()
      {
          $this->middleware('guest:admin')->except('logout');
      }
      /**
       * Display a listing of the resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function login()
      {
          return view('auth.adminLogin');
      }
      public function loginAdmin(LoginAdminForm $request)
      {
          // Attempt to log the user in
          if (
            Auth::guard('admin')->attempt(
                ['email' => $request->email, 'password' => $request->password],
                 $request->remember)) {
              // if successful, then redirect to their intended location
              return redirect()->intended(route('admin.dashboard'));
          }
          // if unsuccessful, then redirect back to the login with the form data
          return redirect()->back()->withInput($request->only('email', 'remember'));
      }
      public function logout()
      {
          \Illuminate\Support\Facades\Auth::guard('admin')->logout();
          return redirect()->route('admin.auth.login');
      }
}
