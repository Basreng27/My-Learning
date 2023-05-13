<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use App\Models\Auth;
use App\Bases\BaseModule;
use App\Services\UsersServices as Service;


class AuthController extends BaseModule
{
    use AuthenticatesUsers;

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
            return $this->serveJSON($validator->errors());
        // return $this->serveValidations($validator->errors());

        $result = Service::store($request);

        // toastr()->error('An error has occurred please try again later.');
        // return $this->serveJSON($result)->with('success', 'Data berhasil disimpan!'); // menambahkan notifikasi berhasil
        return $this->serveJSON($result);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (method_exists($this, 'hasTooManyLoginAttempts') && $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            // createActivityLog('Berhasil Login');

            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        // createActivityLog('Gagal Login');

        return $this->sendFailedLoginResponse($request);
    }
}
