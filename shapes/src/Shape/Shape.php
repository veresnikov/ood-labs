<?php
declare(strict_types=1);

namespace App\Shape;

use App\Canvas\CanvasInterface;
use App\Color\Color;

abstract class Shape
{
    private Color $color;

    public function __construct(Color $color)
    {
        $this->color = $color;
    }

    public function getColor(): Color
    {
        return $this->color;
    }

    public abstract function Draw(CanvasInterface $canvas);
}