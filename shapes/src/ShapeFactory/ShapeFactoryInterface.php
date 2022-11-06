<?php
declare(strict_types=1);

namespace App\ShapeFactory;

use App\Shape\Shape;

interface ShapeFactoryInterface
{
    public function CreateShape(string $input): Shape;
}