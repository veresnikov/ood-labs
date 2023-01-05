<?php
declare(strict_types=1);

namespace Application\Canvas;

class RGBAColor
{
    public function __construct(
        public float $r = 0,
        public float $g = 0,
        public float $b = 0,
        public float $a = 0,
    )
    {
    }
}