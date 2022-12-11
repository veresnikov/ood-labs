<?php
declare(strict_types=1);

namespace App\Application;

use App\GraphicsLib\CanvasInterface;
use App\ModernGraphicsLib\ModernGraphicsRenderer;
use App\ModernGraphicsLib\Point;

class ModernGraphicsLibObjectAdapter implements CanvasInterface
{
    private Point $start;

    public function __construct(private ModernGraphicsRenderer $modernGraphicsRenderer)
    {
        $this->start = new Point(0, 0);
    }

    public function MoveTo(int $x, int $y): void
    {
        $this->start->x = $x;
        $this->start->y = $y;
    }

    public function LineTo(int $x, int $y): void
    {
        $this->modernGraphicsRenderer->DrawLine($this->start, new Point($x, $y));
        $this->start->x = $x;
        $this->start->y = $y;
    }
}