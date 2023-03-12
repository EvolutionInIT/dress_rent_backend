<?php

namespace App\Helpers\V1;

class Helper {

    /**
     * @param int $size
     * @param false $onlyDigits
     * @return string
     */
    public static function getRandomString(int $size = 10, bool $onlyDigits = false): string
    {
        $permittedChars = $onlyDigits ? '0123456789' : '0123456789abcdefghijklmnopqrstuvwxyz';

        return substr(str_shuffle($permittedChars), 0, $size);
    }

}

