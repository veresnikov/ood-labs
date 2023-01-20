<?php
declare(strict_types=1);

namespace App\Shapes;

use App\Canvas\Point;

class Frame
{
    public Point $topLeft;

    public float $width;

    public float $height;

    public function getTopLeft(): Point
    {
        return $this->topLeft;
    }

    public function getTopRight(): Point
    {
        $point = clone $this->topLeft;
        $point->x = $point->x + $this->width;
        return $point;
    }

    public function getBottomLeft(): Point
    {
        $point = clone $this->topLeft;
        $point->y = $point->y + $this->height;
        return $point;
    }

    public function getBottomRight(): Point
    {
        $point = clone $this->topLeft;
        $point->x = $point->x + $this->width;
        $point->y = $point->y + $this->height;
        return $point;
    }

    public static function isEqual(Frame $first, Frame $second): bool
    {
        return Point::isEqual($first->topLeft, $second->topLeft) &&
            $first->width === $second->width &&
            $first->height === $second->height;
    }
}