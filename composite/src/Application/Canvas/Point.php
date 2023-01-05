<?php
declare(strict_types=1);

namespace Application\Canvas;
class Point
{
    public float $x;
    public float $y;

    public static function isEqual(Point $first, Point $second): bool
    {
        return ($first->x === $second->x) && ($first->y === $second->y);
    }
}