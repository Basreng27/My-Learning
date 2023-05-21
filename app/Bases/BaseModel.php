<?php

namespace App\Bases;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Traits\ModelScopes;

class BaseModel extends Model
{
    use ModelScopes;

    public $incrementing = false;
    protected $keyType = 'string';


    public static function createOne(array $data, $callback = null)
    {
        $model = new static;
        $model->fill($data);

        if ($callback)
            $callback($model);

        $model->save();
        return $model;
    }

    // public function getCreatedAtAttribute($value)
    // {
    //     return $this->attributes['created_at'] = formatDefaultDateTime($value);
    // }

    // public function getUpdatedAtAttribute($value)
    // {
    //     return $this->attributes['updated_at'] = formatDefaultDateTime($value);
    // }
}
