<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasUUID
{

    /**
     * Generate UUID.
     *
     * @return string
     */
    private static function UUID()
    {
        return (string) Str::uuid();
    }

    /**
     * Boot model class.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = self::UUID();
        });
    }
}
