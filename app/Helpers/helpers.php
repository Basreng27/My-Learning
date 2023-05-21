<?php

// helper link
if (!function_exists('template_gentelellaMaster')) {
    function template_gentelellaMaster()
    {
        return asset('plugins/admins/gentelellaMaster');
    }
};

if (!function_exists('template_custom')) {
    function template_custom()
    {
        return asset('custom');
    }
};

// helper activitylog
if (!function_exists('createActivityLog')) {
    /**
     * Call API.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    function createActivityLog($message)
    {
        try {
            $user = auth()->user();
            $username = ($user->name ?? 'User');

            activity()->log($username . ' - ' . $message);
        } catch (Exception $e) {
        }
    }
}

// permission
if (!function_exists('getListPermissionName')) {
    function getListPermissionName()
    {
        return [
            'index' => 'Lihat',
            'show' => 'Detail',
            'create' => 'Buat',
            'edit' => 'Ubah',
            'delete' => 'Hapus',
            'approve' => 'Persetujuan',
            'import' => 'Impor',
            'export' => 'Cetak',
            'execute' => 'Eksekusi'
        ];
    }
}
