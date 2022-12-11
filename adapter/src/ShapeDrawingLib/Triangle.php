<?php
declare(strict_types=1);

namespace App\ShapeDrawingLib;

use App\GraphicsLib\CanvasInterface;

class Triangle implements CanvasDrawableInterface
{
    public function __construct(
        private Point $firstVertex,
        private Point $secondVertex,
        private Point $thridVertex,
    )
    {
    }

    public function Draw(CanvasInterface $canvas): void
    {
        $canvas->MoveTo($this->firstVertex->x, $this->firstVertex->y);
        $canvas->LineTo($this->secondVertex->x, $this->secondVertex->y);
        $canvas->LineTo($this->thridVertex->x, $this->thridVertex->y);
        $canvas->LineTo($this->firstVertex->x, $this->firstVertex->y);
    }
}