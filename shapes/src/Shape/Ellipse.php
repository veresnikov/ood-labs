<?php
declare(strict_types=1);

namespace App\Shape;

use App\Canvas\CanvasInterface;
use App\Color\Color;
use App\Point\Point;

class Ellipse extends Shape
{
    private Point $center;
    private int $widthRadius;
    private int $heightRadius;

    public function __construct(Color $color, Point $center, int $widthRadius, int $heightRadius)
    {
        parent::__construct($color);
        $this->center = $center;
        $this->widthRadius = $widthRadius;
        $this->heightRadius = $heightRadius;
    }

    public function Draw(CanvasInterface $canvas): void
    {
        $canvas->SetColor($this->getColor());
        $canvas->DrawEllipse($this->center, $this->widthRadius, $this->heightRadius);
    }

    public function getCenter(): Point
    {
        return $this->center;
    }

    public function getWidthRadius(): int
    {
        return $this->widthRadius;
    }

    public function getHeightRadius(): int
    {
        return $this->heightRadius;
    }
}