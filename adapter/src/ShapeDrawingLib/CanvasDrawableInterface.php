<?php
declare(strict_types=1);

namespace App\ShapeDrawingLib;

use App\GraphicsLib\CanvasInterface;

interface CanvasDrawableInterface
{
    public function Draw(CanvasInterface $canvas): void;
}