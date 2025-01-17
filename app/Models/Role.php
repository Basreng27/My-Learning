<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Models\Role as Model;

use App\Traits\ModelScopes;

class Role extends Model
{
    use ModelScopes, SoftDeletes;

    protected $table = 'roles'; // Table name
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    /*
     * Defining Fillable Attributes On A Model
     */
    protected $fillable = [
        'code',
        'name',
        'guard_name',
        'status'
    ];

    /*
     * Relationship
     */
    // public function listUsers()
    // {
    //     return $this->belongsToMany(User::class, 'user_roles', 'role_id', 'user_id', 'id');
    // }

    public function menus()
    {
        // many to many
        return $this->belongsToMany(Menu::class, 'menu_permission', 'role_id', 'menu_id')->orderBy('sequence', 'ASC');
    }

    // public function permissions(): BelongsToMany
    // {
    //     return $this->belongsToMany(Permission::class, config('permission.table_names.role_has_permissions'), 'role_id', 'permission_id');
    // }
}
