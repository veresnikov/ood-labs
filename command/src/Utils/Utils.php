<?php
declare(strict_types=1);

namespace App\Utils;

class Utils
{
    public static function Swap(&$x, &$y): void
    {
        $tmp = $x;
        $x = $y;
        $y = $tmp;
    }

    public static function ArrayEmplace(array &$array, int $position, $value): void
    {
        print_r(array_keys($array));
        $pos = array_search($position, array_keys($array));
        $array = array_merge(
            array_slice($array, 0, $pos),
            [$value],
            array_slice($array, $pos),
        );
    }
}