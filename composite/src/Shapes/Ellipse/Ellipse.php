<?php
declare(strict_types=1);

namespace App\Shapes\Ellipse;

use App\Canvas\CanvasInterface;
use App\Canvas\Point;
use App\Shapes\Base\Shape;
use App\Shapes\Frame;

class Ellipse extends Shape
{
    public function __construct(
        private Point $center,
        private float $height,
        private float $width,
    )
    {
        parent::__construct();
    }

    public function Draw(CanvasInterface $canvas): void
    {
        $canvas->DrawEllipse(
            $this->center,
            $this->height,
            $this->width,
            $this->GetFillColor(),
            $this->GetOutlineColor(),
            $this->GetOutlineThickness()
        );
    }

    public function GetFrame(): ?Frame
    {
        $frame = new Frame();
        $topLeft = new Point();
        $topLeft->x = $this->center->x - $this->width;
        $topLeft->y = $this->center->y - $this->height;
        $frame->topLeft = $topLeft;
        $frame->height = $this->height * 2;
        $frame->width = $this->width * 2;
        return $frame;
    }

    public function SetFrame(Frame $frame): void
    {
        $this->center->x = $frame->topLeft->x + $frame->width;
        $this->center->y = $frame->topLeft->y + $frame->height;
        $this->width = $frame->width / 2;
        $this->height = $frame->height / 2;
    }
}