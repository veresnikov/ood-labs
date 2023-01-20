<?php
declare(strict_types=1);

namespace App\Task;

use App\Canvas\SVGCanvas;
use App\Designer\Designer;
use App\Painter\Painter;
use App\ShapeFactory\ShapeFactory;

class ShapesTask implements TaskInterface
{
    public function Execute(int $argc, array $argv): void
    {
        $factory = new ShapeFactory();
        $designer = new Designer($factory);
        $draft = $designer->CreateDraft(STDIN);
        $canvas = new SVGCanvas(1000, 1000);
        Painter::DrawPicture($draft, $canvas);
        echo $canvas->Draw() . PHP_EOL;
    }
}