<?php
declare(strict_types=1);

namespace App\Canvas;

use App\Color\Color;
use App\Point\Point;

class ConsoleCanvas implements CanvasInterface
{
    public function SetColor(Color $color): void
    {
        echo "Set color: {$color->name}" . PHP_EOL;
    }

    public function DrawLine(Point $from, Point $to): void
    {
        echo "Draw line: ({$from->getX()}, {$from->getY()}) to ({$to->getX()}, {$to->getY()})" . PHP_EOL;
    }

    public function DrawEllipse(Point $center, int $widthRadius, int $heightRadius): void
    {
        echo "Draw ellipse: ({$center->getX()}, {$center->getY()}), width radius ({$widthRadius}), height radius ({$heightRadius})" . PHP_EOL;
    }
}