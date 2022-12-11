<?php
declare(strict_types=1);

namespace App\GraphicsLib;

interface CanvasInterface
{
    public function MoveTo(int $x, int $y): void;

    public function LineTo(int $x, int $y): void;
}