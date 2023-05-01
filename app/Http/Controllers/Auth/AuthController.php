<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->module = 'auth';
        $this->pageTitle = 'Login';
        $this->pageSubTitle = 'Login';
    }

    public function index()
    {
        return view('auth.login');
        // return $this->serveView();
    }

    public function regist(Request $request)
    {
        dd($request);
    }
}
