<?php
declare(strict_types=1);

namespace App\Canvas;

class SVGCanvas implements CanvasInterface
{
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

    public function DrawLine(Point $start, Point $end, ?RGBAColor $color, ?float $thickness): void
    {
        $x1 = $start->x;
        $y1 = $start->y;
        $x2 = $end->x;
        $y2 = $end->y;
        $strokeColor = $this->GetStrokeColor($color);
        $strokeWidth = $this->GetStrokeWidth($thickness);
        $this->items[] = "<line x1=\"$x1\" y1=\"$y1\" x2=\"$x2\" y2=\"$y2\" {$strokeColor} {$strokeWidth}/>";
    }

    /**
     * @inheritDoc
     */
    public function DrawPolygon(array $points, ?RGBAColor $fillColor, ?RGBAColor $outlineColor, ?float $thickness): void
    {
        $svgPoints = $this->GetPoints($points);
        $color = $this->GetFillColor($fillColor);
        $strokeColor = $this->GetStrokeColor($outlineColor);
        $strokeWidth = $this->GetStrokeWidth($thickness);
        $this->items[] = "<polygon $svgPoints $color $strokeColor $strokeWidth/>";
    }

    public function DrawEllipse(Point $center, float $height, float $width, ?RGBAColor $fillColor, ?RGBAColor $outlineColor, ?float $thickness): void
    {
        $x = $center->x;
        $y = $center->y;
        $color = $this->GetFillColor($fillColor);
        $strokeColor = $this->GetStrokeColor($outlineColor);
        $strokeWidth = $this->GetStrokeWidth($thickness);
        $this->items[] = "<ellipse cx=\"$x\" cy=\"$y\" rx=\"$width\" ry=\"$height\" $color $strokeColor $strokeWidth/>";
    }

    private function GetFillColor(?RGBAColor $color): string
    {
        if (!$color) {
            return "fill-opacity=\"0\"";
        }
        $color = sprintf("#%02x%02x%02x", $color->r, $color->g, $color->b);
        return "fill=\"{$color}\"";
    }

    private function GetStrokeColor(?RGBAColor $color): string
    {
        if (!$color) {
            return "";
        }
        $color = sprintf("#%02x%02x%02x", $color->r, $color->g, $color->b);
        return "stroke=\"{$color}\"";
    }

    private function GetStrokeWidth(?float $thickness): string
    {
        if (!$thickness) {
            return "";
        }
        return "stroke-width=\"{$thickness}\"";
    }

    /**
     * @param Point[] $points
     * @return string
     */
    private function GetPoints(array $points): string
    {
        $value = "";
        foreach ($points as $point) {
            $x = $point->x;
            $y = $point->y;
            $value .= "{$x},{$y} ";
        }
        return "points=\"{$value}\"";
    }
}