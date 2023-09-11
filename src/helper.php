<?php

use Carbon\Carbon;


if (!function_exists('currentTimestamp')) {

    /**
     *
     * Get current time with default asia/jakarta timezone
     *
     * @param string $timezone
     * @return Carbon
     */
    function currentTimestamp(string $timezone = 'Asia/Jakarta'): Carbon
    {
        return Carbon::now()->timezone($timezone);
    }
}

if (!function_exists('int_rand')) {
    /**
     * Random integer only
     *
     * @param int $length
     * @return string
     */
    function int_rand(int $length): string
    {
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 9);
        }
        return $result;
    }
}