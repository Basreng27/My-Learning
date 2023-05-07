<?php

namespace App\Traits;

use Webpatser\Uuid\Uuid;

trait UuidTrait
{
    public static function boot()
    {
        parent::boot();

        static::creatin(function ($model) {
            if (empty($model->{$model->getKeyName()}))
                $model->{$model->getKeyName()} = Uuid::generate(4)->string;
        });
    }
}
