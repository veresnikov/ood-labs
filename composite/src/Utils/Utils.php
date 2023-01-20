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
        $pos = array_search($position, array_keys($array));
        $array = array_merge(
            array_slice($array, 0, $pos),
            [$value],
            array_slice($array, $pos),
        );
    }

    public static function PregMatch(string $pattern, string $subject, &$matches, int $flags = 0, int $offset = 0): int
    {
        $r = preg_match($pattern, $subject, $matches, $flags, $offset);
        if ($r === false) {
            return 0;
        }
        return $r;
    }
}