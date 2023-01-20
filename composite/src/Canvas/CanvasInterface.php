<?php
declare(strict_types=1);

namespace App\Canvas;
interface CanvasInterface
{
    public function DrawLine(Point $start, Point $end, ?RGBAColor $color, ?float $thickness): void;

    /**
     * @param Point[] $points
     * @param RGBAColor|null $fillColor
     * @param RGBAColor|null $outlineColor
     * @param float|null $thickness
     * @return void
     */
    public function DrawPolygon(
        array      $points,
        ?RGBAColor $fillColor,
        ?RGBAColor $outlineColor,
        ?float     $thickness
    ): void;

    public function DrawEllipse(
        Point      $center,
        float      $height,
        float      $width,
        ?RGBAColor $fillColor,
        ?RGBAColor $outlineColor,
        ?float     $thickness
    ): void;
}