<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\ModelScopes;
// ==============================
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use ModelScopes, HasRoles, SoftDeletes;
    // use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users'; // teble name
    protected $keyType = 'string'; // type data primary key
    protected $logFillable = true; // fillable
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'username',
        'email',
        'password',
    ]; // field yang di izinkan
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ]; // hiddem field saat ditampilkan menjadi json

    public static function createOne(array $data, $callback = null)
    {
        // dd($data);
        $model = new static;
        $model->fill($data);

        if ($callback) {
            $callback($model);
        }

        $model->save();
        return $model;
    }

    public function roles()
    {
        // Define a many-to-many relationship with the Role model
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id')
            ->withPivot('model_type');
    }

    // public function profil()
    // {
    //     return $this->belongsTo(Profil::class, 'profil_id', 'id');
    // }
}
