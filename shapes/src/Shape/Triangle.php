<?php
declare(strict_types=1);

namespace App\Shape;

use App\Canvas\CanvasInterface;
use App\Color\Color;
use App\Point\Point;

class Triangle extends Shape
{
    private Point $first;
    private Point $second;
    private Point $three;

    public function __construct(Color $color, Point $first, Point $second, Point $three)
    {
        parent::__construct($color);
        $this->first = $first;
        $this->second = $second;
        $this->three = $three;
    }

    public function Draw(CanvasInterface $canvas): void
    {
        $canvas->SetColor($this->getColor());
        $canvas->DrawLine($this->first, $this->second);
        $canvas->DrawLine($this->second, $this->three);
        $canvas->DrawLine($this->three, $this->first);
    }
}