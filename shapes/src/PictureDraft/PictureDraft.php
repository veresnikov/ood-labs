<?php
declare(strict_types=1);

namespace App\PictureDraft;

use App\PictureDraft\Exception\OutOfRange;
use App\Shape\Shape;

class PictureDraft
{
    private array $shapes = [];

    public function GetShapesCount(): int
    {
        return count($this->shapes);
    }

    /**
     * @throws OutOfRange
     */
    public function GetShape(int $index): Shape
    {
        if ($index >= $this->GetShapesCount() || $index < 0) {
            throw new OutOfRange();
        }
        return $this->shapes[$index];
    }

    public function AddShape(Shape $shape): void
    {
        $this->shapes[] = $shape;
    }
}