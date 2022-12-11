<?php
declare(strict_types=1);

namespace App\ShapeDrawingLib;

use App\GraphicsLib\CanvasInterface;

class CanvasPainter
{
    public function __construct(
        private CanvasInterface $canvas,
    )
    {
    }

    public function Draw(CanvasDrawableInterface $drawable): void
    {
        $drawable->Draw($this->canvas);
    }
}