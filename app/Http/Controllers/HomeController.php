<?php

namespace App\Http\Controllers;

use App\Bases\BaseModule;
use Illuminate\Support\Facades\Hash;

class HomeController extends BaseModule
{
    public function __construct()
    {
        $this->module = 'home';
        $this->pageTitle = 'Dashboard';
        $this->pageSubTitle = 'Home';
        $this->permissionList = [
            "index" => ['index'],
        ];
    }

    public function index()
    {
        return $this->serveView(viewBlade: 'dashboard');
    }
}
