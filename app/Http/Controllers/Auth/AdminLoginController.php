<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController as  DefaultLoginController;

class AdminLoginController extends DefaultLoginController
{
    protected $redirectTo = '/admin';

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
    
    public function showLoginForm()
    {
        return view('auth.admin');
    }
    
    public function username()
    {
        return 'email';
    }
    
    protected function guard()
    {
        return Auth::guard('admin');
    }
}