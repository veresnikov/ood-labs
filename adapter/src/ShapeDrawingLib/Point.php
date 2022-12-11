<?php
declare(strict_types=1);

namespace App\ShapeDrawingLib;

class Point
{
    public function __construct(
        public int $x,
        public int $y,
    )
    {
    }
}