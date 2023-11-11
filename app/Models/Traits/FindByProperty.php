<?php

namespace App\Models\Traits;

trait FindByProperty
{
    /**
     * Extends functionality to include a findBy method. Provide the key and value to get the model.
     *
     * @param string $key
     * @param mixed $value
     * @return object
     */
    public static function findBy(string $key, mixed $value)
    {
        if (is_array($value)) {
            return self::whereIn($key, $value)->get();
        }

        return self::where($key, "=", $value)->first();
    }
}
