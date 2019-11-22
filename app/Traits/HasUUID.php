<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasUUID
{
    /**
     * Boot model class.
     */
    protected static function bootHasUUID()
    {
        static::creating(function ($model) {
            /*
             * @var \Illuminate\Database\Eloquent\Model
             */
            if (! $model->getKey()) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
    }

    /**
     * Do not increment primary key.
     *
     * @return bool
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * Return primary key type.
     *
     * @return string
     */
    public function getKeyType()
    {
        return 'string';
    }
}
