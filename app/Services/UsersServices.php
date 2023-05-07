<?php

namespace App\Services;

use Yajra\DataTables\Facades\DataTables; //package untuk return data langsung dataTables untuk di json
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt; //package untuk encrpy decrypt
use Ramsey\Uuid\Uuid;

use App\Bases\BaseServices;
use App\Models\Users as Model;

// use App\Models\Role;

class UsersServices extends BaseServices
{
    // simpan data
    public static function store($request)
    {
        return DB::transaction(function () use ($request) {
            return Model::createOne([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make(strtolower($request->password)),
                'user_id' => Crypt::encrypt($request->username), // encrypt code
                // 'user_id' => Uuid::fromString($request->username), // UUID to string
            ]);
        });

        // , function ($query, $event) use ($request) {
        //     // $event->assignRole(is_array($request->roles) ? $request->roles : []);

        //     createActivityLog('Berhasil Membuat Akun User ' . $request->email);
        // }
    }
}
