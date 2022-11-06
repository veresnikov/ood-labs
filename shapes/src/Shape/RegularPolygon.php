<?php
declare(strict_types=1);

namespace App\Shape;

use App\Canvas\CanvasInterface;
use App\Color\Color;
use App\Point\Point;
use App\Shape\Exception\InvalidVertexCount;

class RegularPolygon extends Shape
{
    private Point $center;
    private int $pointsCount;
    private int $radius;

    /**
     * @throws InvalidVertexCount
     */
    public function __construct(Color $color, Point $center, int $pointsCount, int $radius)
    {
        if ($pointsCount < 3) {
            throw new InvalidVertexCount();
        }
        parent::__construct($color);
        $this->center = $center;
        $this->pointsCount = $pointsCount;
        $this->radius = $radius;
    }

    public function Draw(CanvasInterface $canvas): void
    {
        $canvas->SetColor($this->getColor());
        $points = $this->GetPoints();
        for ($index = 0; $index < $this->pointsCount - 1; $index++) {
            $canvas->DrawLine($points[$index], $points[$index + 1]);
        }
        $canvas->DrawLine($points[$this->pointsCount - 1], $points[0]);
    }

    public function GetPoints(): array
    {
        $points = [];
        $angle = 2 * pi() / $this->pointsCount;
        for ($index = 0; $index < $this->pointsCount; $index++) {
            $points[] = new Point(
                $this->center->getX() + $this->radius * cos($angle * $index),
                $this->center->getY() + $this->radius * sin($angle * $index),
            );
        }
        return $points;
    }
}