<?php
declare(strict_types=1);

namespace Application\Shapes;

use Application\Canvas\CanvasInterface;

interface DrawableShapeInterface
{
    public function Draw(CanvasInterface $canvas): void;
}