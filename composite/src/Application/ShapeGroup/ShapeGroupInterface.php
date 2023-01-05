<?php
declare(strict_types=1);

namespace Application\ShapeGroup;

use Application\Shapes\ShapeInterface;

interface ShapeGroupInterface extends ShapeInterface
{
    public function GetShapesCount(): int;

    public function GetShape(int $index): ShapeInterface;

    public function Insert(ShapeInterface $shape, ?int $index = null): void;

    public function Remove(int $index): void;
}