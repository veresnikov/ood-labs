<?php
declare(strict_types=1);

namespace App\ShapeDrawingLib;

use App\GraphicsLib\CanvasInterface;

class Rectangle implements CanvasDrawableInterface
{
    public function __construct(
        private Point $leftTopVertex,
        private int   $width,
        private int   $height,
    )
    {
    }

    public function Draw(CanvasInterface $canvas): void
    {
        $canvas->MoveTo($this->leftTopVertex->x, $this->leftTopVertex->y);
        $canvas->LineTo($this->leftTopVertex->x + $this->width, $this->leftTopVertex->y);
        $canvas->LineTo($this->leftTopVertex->x + $this->width, $this->leftTopVertex->y - $this->height);
        $canvas->LineTo($this->leftTopVertex->x, $this->leftTopVertex->y - $this->height);
        $canvas->LineTo($this->leftTopVertex->x, $this->leftTopVertex->y);
    }
}