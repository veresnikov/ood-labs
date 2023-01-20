<?php
declare(strict_types=1);

namespace App\Task;

use App\Canvas\Point;
use App\Canvas\RGBAColor;
use App\Canvas\SVGCanvas;
use App\ShapeGroup\ShapeGroup;
use App\Shapes\Rectangle\Rectangle;
use App\Shapes\ShapeInterface;

class ExampleTask implements TaskInterface
{
    public function Execute(int $argc, array $argv): void
    {
        $canvas = new SVGCanvas(1024, 720);
        $this->GetChristmasTree()->Draw($canvas);
        echo $canvas->Draw();
    }

    private function GetChristmasTree(): ShapeInterface
    {
        $p = new Point();
        $p->x = 100;
        $p->y = 400;
        $trunk = new Rectangle($p, 75, 400);
        $trunk->GetFillStyle()->SetColor(new RGBAColor(101, 67, 33, 1));
        $trunk->GetFillStyle()->Enable();
        return new ShapeGroup([
            $trunk
        ]);
    }
}