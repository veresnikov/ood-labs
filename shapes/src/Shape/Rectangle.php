<?php
declare(strict_types=1);

namespace App\Shape;

use App\Canvas\CanvasInterface;
use App\Color\Color;
use App\Point\Point;

class Rectangle extends Shape
{
    private Point $topLeft;
    private int $width;
    private int $height;

    public function __construct(Color $color, Point $topLeft, int $width, int $height)
    {
        parent::__construct($color);
        $this->topLeft = $topLeft;
        $this->width = $width;
        $this->height = $height;
    }

    public function Draw(CanvasInterface $canvas): void
    {
        $canvas->SetColor($this->getColor());
        $topRight = new Point($this->topLeft->getX() + $this->width, $this->topLeft->getY());
        $bottomRight = new Point($this->topLeft->getX() + $this->width, $this->topLeft->getY() - $this->height);
        $bottomLeft = new Point($this->topLeft->getX(), $this->topLeft->getY() - $this->height);

        $canvas->DrawLine($this->topLeft, $topRight);
        $canvas->DrawLine($topRight, $bottomRight);
        $canvas->DrawLine($bottomRight, $bottomLeft);
        $canvas->DrawLine($this->topLeft, $this->topLeft);
    }

    public function getTopLeft(): Point
    {
        return $this->topLeft;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }
}