<?php
declare(strict_types=1);

namespace App\Application;

use App\GraphicsLib\CanvasInterface;
use App\ModernGraphicsLib\ModernGraphicsRenderer;
use App\ModernGraphicsLib\Point;
use App\ModernGraphicsLib\RGBAColor;

class ModernGraphicsLibObjectAdapter implements CanvasInterface
{
    private Point $start;

    private RGBAColor $color;

    public function __construct(private ModernGraphicsRenderer $modernGraphicsRenderer)
    {
        $this->start = new Point(0, 0);
        $this->color = new RGBAColor(0, 0, 0, 1);
    }

    public function MoveTo(int $x, int $y): void
    {
        $this->start->x = $x;
        $this->start->y = $y;
    }

    public function LineTo(int $x, int $y): void
    {
        $this->modernGraphicsRenderer->DrawLine($this->start, new Point($x, $y), $this->color);
        $this->start->x = $x;
        $this->start->y = $y;
    }

    public function SetColor(int $rgbColor): void
    {
        $this->color->r = (float)(($rgbColor >> 16) & 0xFF) / 255;
        $this->color->g = (float)(($rgbColor >> 8) & 0xFF) / 255;
        $this->color->b = (float)($rgbColor & 0xFF) / 255;
    }
}