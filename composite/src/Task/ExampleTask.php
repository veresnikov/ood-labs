<?php
declare(strict_types=1);

namespace App\Task;

use App\Canvas\Point;
use App\Canvas\RGBAColor;
use App\Canvas\SVGCanvas;
use App\ShapeGroup\ShapeGroup;
use App\Shapes\Ellipse\Ellipse;
use App\Shapes\Frame;
use App\Shapes\Rectangle\Rectangle;
use App\Shapes\ShapeInterface;
use App\Shapes\Triangle\Triangle;

class ExampleTask implements TaskInterface
{
    public function Execute(int $argc, array $argv): void
    {
        $canvas = new SVGCanvas(1024, 1024);

        $image = new ShapeGroup([
            $this->GetBackground(1024, 1024),
            $this->GetTrees(),
        ]);
        $image->Draw($canvas);
        echo $canvas->Draw();
    }

    private function GetChristmasTree(int $x, int $y): ShapeInterface
    {
        $base = new Point();
        $base->x = $x;
        $base->y = $y;

        $p = clone $base;
        $p->y = $p->y + 550;
        $trunk = new Rectangle($p, 25, 100);
        $trunk->GetFillStyle()->SetColor(new RGBAColor(101, 67, 33, 1));
        $trunk->GetFillStyle()->Enable();
        $trunk->GetOutlineStyle()->SetColor(new RGBAColor());
        $trunk->GetOutlineStyle()->Enable();

        $p1 = clone $base;
        $p1->x = $p1->x + 25 / 2;
        $p2 = clone $p1;
        $p2->x = $p2->x + 50;
        $p2->y = $p2->y + 600;
        $p3 = clone $p1;
        $p3->x = $p3->x - 50;
        $p3->y = $p3->y + 600;
        $body = new Triangle($p1, $p2, $p3);
        $body->GetFillStyle()->SetColor(new RGBAColor(72, 178, 58, 1));
        $body->GetFillStyle()->Enable();
        $body->GetOutlineStyle()->SetColor(new RGBAColor());
        $body->GetOutlineStyle()->Enable();

        return new ShapeGroup([
            $trunk,
            $body,
        ]);
    }

    private function GetTree(int $x, int $y): ShapeInterface
    {
        $base = new Point();
        $base->x = $x;
        $base->y = $y;

        $p = clone $base;
        $p->y = $p->y + 550;
        $trunk = new Rectangle($p, 25, 100);
        $trunk->GetFillStyle()->SetColor(new RGBAColor(101, 67, 33, 1));
        $trunk->GetFillStyle()->Enable();
        $trunk->GetOutlineStyle()->SetColor(new RGBAColor());
        $trunk->GetOutlineStyle()->Enable();

        $center = clone $base;
        $center->x = $center->x + 25 / 2;
        $center->y = $center->y + 300;
        $body = new Ellipse($center, 300, 75);
        $body->GetFillStyle()->SetColor(new RGBAColor(72, 178, 58, 1));
        $body->GetFillStyle()->Enable();
        $body->GetOutlineStyle()->SetColor(new RGBAColor());
        $body->GetOutlineStyle()->Enable();

        return new ShapeGroup([
            $trunk,
            $body,
        ]);
    }

    private function GetTrees(): ShapeInterface
    {
        return new ShapeGroup([
            $this->GetChristmasTree(225, 180),
            $this->GetTree(350, 200),
            $this->GetChristmasTree(475, 170),
            $this->GetTree(600, 180),
        ]);
    }

    private function GetMeadow(float $x, float $y, float $width, float $height): ShapeInterface
    {
        $topLeft = new Point();
        $topLeft->x = $x;
        $topLeft->y = $y;
        $meadow = new Rectangle($topLeft, $width, $height);
        $meadow->GetFillStyle()->SetColor(new RGBAColor(110, 146, 48));
        $meadow->GetFillStyle()->Enable();
        return $meadow;
    }

    private function GetSky(float $width, float $height): ShapeInterface
    {
        $topLeft = new Point();
        $topLeft->x = 0;
        $topLeft->y = 0;
        $sky = new Rectangle($topLeft, $width, $height);
        $sky->GetFillStyle()->SetColor(new RGBAColor(186, 245, 253));
        $sky->GetFillStyle()->Enable();
        return $sky;

    }

    private function GetBackground(int $width, int $height): ShapeInterface
    {
        $sky = $this->GetSky($width, $height / 3);
        $meadow = $this->GetMeadow(0, $height / 3, $width, $height / 2);
        return new ShapeGroup([
            $sky,
            $meadow,
        ]);
    }
}