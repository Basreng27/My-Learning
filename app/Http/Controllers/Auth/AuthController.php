<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Http\Controllers\Controller;
use App\Models\Auth;
use App\Bases\BaseModule;
use App\Services\UsersServices as Service;


class AuthController extends BaseModule
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
        // cek validator
        $validator = Validator::make(
            $request->all(),
            [
                'username' => ['required', Rule::unique('users')->whereNull('deleted_at')], //jangan ada username yang sama pada table users yang deleted_at nya kosong
                'email' => ['required', Rule::unique('users')->whereNull('deleted_at')], //jangan ada email yang sama pada table users yang deleted_at nya kosong
                'password' => 'required',
            ],
            [
                'username.required' => 'Username harus diisi',
                'username.unique' => 'Username sudah digunakan',
                'email.required' => 'Email harus diisi',
                'email.unique' => 'Email sudah digunakan',
                'password.required' => 'Password harus diisi',
            ] //Atribut Custom
        );

        // cek jika $validator gagal
        if ($validator->fails())
            return $this->serveValidations($validator->errors());

        $result = Service::store($request);

        return $this->serveJSON($result);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'password' => 'required|string'
        ]);
    }
}
