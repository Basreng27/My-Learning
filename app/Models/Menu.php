<?php

namespace App\Models;

use App\Bases\BaseModel;

class Menu extends BaseModel
{
    protected $table = 'menus'; // Table name
    protected $keyType = 'string';

    /*
     * Defining Fillable Attributes On A Model
     */
    protected $fillable = [
        'id',
        'parent_id',
        'code',
        'name',
        'url',
        'icon',
        'sequence',
    ];

    public function permissions()
    {
        // many to many
        return $this->belongsToMany(Permission::class, 'menu_has_permissions', 'menu_id', 'permission_id')
            ->withPivot('name', 'sequence');
    }

    // public function roles()
    // {
    //     // many to many
    //     return $this->belongsToMany(Role::class, 'menu_permission', 'menu_id', 'role_id');
    // }
}
