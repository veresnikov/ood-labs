<?php
declare(strict_types=1);

namespace App\GraphicsLib;

class Canvas implements CanvasInterface
{
    public function MoveTo(int $x, int $y): void
    {
        echo "MoveTo ($x, $y)" . PHP_EOL;
    }

    public function LineTo(int $x, int $y): void
    {
        echo "LineTo ($x, $y)" . PHP_EOL;
    }
}