<?php
declare(strict_types=1);

namespace App\Canvas;

use App\Color\Color;
use App\Point\Point;

interface CanvasInterface
{
    public function SetColor(Color $color): void;
    public function DrawLine(Point $from, Point $to): void;
    public function DrawEllipse(Point $center, int $widthRadius, int $heightRadius): void;
}