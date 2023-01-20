<?php
declare(strict_types=1);

namespace App\Canvas;

use App\Color\Color;
use App\Point\Point;
use App\ShapeFactory\Exception\InvalidColor;

class SVGCanvas implements CanvasInterface
{
    private Color $color;

    public function __construct(
        private readonly int $width,
        private readonly int $height,
    )
    {
    }

    /**
     * @var string[]
     */
    private array $items = [];

    public function SetColor(Color $color): void
    {
        $this->color = $color;
    }

    public function Draw(): string
    {
        $items = implode(PHP_EOL, $this->items);
        $width = $this->width;
        $height = $this->height;
        return "
            <svg width=\"$width\" height=\"$height\">
                $items
            </svg>
        ";
    }

    public function DrawLine(Point $from, Point $to): void
    {
        $x1 = $from->getX();
        $y1 = $from->getY();
        $x2 = $to->getX();
        $y2 = $to->getY();
        $this->items[] = "<line x1=\"$x1\" y1=\"$y1\" x2=\"$x2\" y2=\"$y2\" {$this->GetStrokeColor($this->color)} {$this->GetStrokeWidth(1)}/>";
    }

    public function DrawEllipse(Point $center, int $widthRadius, int $heightRadius): void
    {
        $x = $center->getX();
        $y = $center->getY();
        $this->items[] = "<ellipse cx=\"$x\" cy=\"$y\" rx=\"$widthRadius\" ry=\"$heightRadius\" {$this->GetStrokeColor($this->color)} {$this->GetStrokeWidth(1)}/>";
    }

    private function GetStrokeColor(Color $color): string
    {
        $c = match ($color) {
            Color::Red => "red",
            Color::Green => "green",
            Color::Blue => "blue",
            Color::Pink => "pink",
            Color::Yellow => "yellow",
            Color::Black => "black",
            default => throw new InvalidColor(),
        };

        return "stroke=\"{$c}\"";
    }

    private function GetStrokeWidth(?float $thickness): string
    {
        if (!$thickness) {
            return "";
        }
        return "stroke-width=\"{$thickness}\"";
    }
}