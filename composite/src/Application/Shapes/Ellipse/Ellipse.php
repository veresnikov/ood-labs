<?php
declare(strict_types=1);

namespace Application\Shapes\Ellipse;

use Application\Canvas\CanvasInterface;
use Application\Canvas\Point;
use Application\Shapes\Base\Shape;
use Application\Shapes\Frame;

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
        $this->center->x = $frame->topLeft->x + ($frame->width / 2);
        $this->center->y = $frame->topLeft->y + ($frame->height / 2);
        $this->width = $frame->width / 2;
        $this->height = $frame->height / 2;
    }
}