<?php
declare(strict_types=1);

namespace App\ModernGraphicsLib;

class RGBAColor
{
    public function __construct(
        public float $r,
        public float $g,
        public float $b,
        public float $a,
    )
    {
    }
}