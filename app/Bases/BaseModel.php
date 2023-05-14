<?php

namespace App\Bases;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Traits\ModelScopes;

class BaseModel extends Model
{
    use ModelScopes;

    public $incrementing = false;
    protected $keyType = 'string';

    // public function getCreatedAtAttribute($value)
    // {
    //     return $this->attributes['created_at'] = formatDefaultDateTime($value);
    // }

    // public function getUpdatedAtAttribute($value)
    // {
    //     return $this->attributes['updated_at'] = formatDefaultDateTime($value);
    // }
}
