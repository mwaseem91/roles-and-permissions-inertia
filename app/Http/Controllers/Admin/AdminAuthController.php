<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminAuthController extends Controller
{

      public function showLoginForm()
      {
          return Inertia::render('Admin/Login');
      }
  
      public function login(Request $request)
      {
          $request->validate([
              'email' => 'required|email',
              'password' => 'required',
          ]);
  
          if (Auth::attempt($request->only('email', 'password'))) {
              return Redirect::route('dashboard');
          }
  
          return back()->withErrors([
              'email' => 'These credentials do not match our records.',
          ]);
      }
}
