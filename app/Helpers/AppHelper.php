<?php

namespace App\Helpers;

class AppHelper
{
    public static function isProduction()
    {
        return config('app.env') === 'production';
    }

    public static function parseJSON($string)
    {
        if (is_string($string)) {
            $data = json_decode($string);
            if (!($data === null && json_last_error() !== JSON_ERROR_NONE)) {
                return $data;
            }
        }
        return false;
    }
}
