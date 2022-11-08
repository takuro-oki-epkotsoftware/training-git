<?php

namespace App;

class Helper
{
    public static function same($value1, $value2, $value3)
    {
        $result = false;
        if ($value1 === $value2 && $value2 === $value3) {
            $result = true;
        }
        return $result;
    }

    public static function same2($value1, $value2, $value3): bool
    {
        $result = $value1 === $value2 && $value2 === $value3;
        if ($result) {
            return true;
        }
        return false;
    }
    public static function same3($value1, $value2, $value3): bool
    {
        $result = $value1 === $value2 && $value2 === $value3;
        return $result;
    }
    public static function same4($value1, $value2, $value3): bool
    {
        return $value1 === $value2 && $value2 === $value3;
    }
}
