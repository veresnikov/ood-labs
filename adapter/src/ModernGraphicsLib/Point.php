<?php
declare(strict_types=1);

namespace App\ModernGraphicsLib;

class Point
{
    public function __construct(
        public int $x,
        public int $y,
    )
    {
    }
}