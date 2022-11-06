<?php
declare(strict_types=1);

namespace App\Task;

use App\Canvas\ConsoleCanvas;
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
        Painter::DrawPicture($draft, new ConsoleCanvas());
    }
}