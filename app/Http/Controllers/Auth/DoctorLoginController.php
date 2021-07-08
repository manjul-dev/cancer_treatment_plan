<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController as  DefaultLoginController;

class DoctorLoginController extends DefaultLoginController
{
    protected $redirectTo = '/doctor/index';

    public function __construct()
    {
        $this->middleware('guest:doctor')->except('logout');
    }
    
    public function showLoginForm()
    {
        return view('auth.login.doctor');
    }
    
    public function username()
    {
        return 'name';
    }
    
    protected function guard()
    {
        return Auth::guard('doctor');
    }
}