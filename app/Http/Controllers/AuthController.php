<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function logout() {
        Auth::logout();
        return redirect()->route('church.login');
    }

    public function login() {
        return view('pages.user-login-page');
    }

    public function register() {
        return view('pages.user-registration-page');
    }
}
