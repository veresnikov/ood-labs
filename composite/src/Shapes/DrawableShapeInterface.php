<?php
declare(strict_types=1);

namespace App\Shapes;

use App\Canvas\CanvasInterface;

interface DrawableShapeInterface
{
    public function Draw(CanvasInterface $canvas): void;
}