<?php
declare(strict_types=1);

namespace Application\Shapes\Rectangle;

use Application\Canvas\CanvasInterface;
use Application\Canvas\Point;
use Application\Shapes\Base\Shape;
use Application\Shapes\Frame;

class Rectangle extends Shape
{
    public function __construct(
        private Point $topLeft,
        private float $width,
        private float $height,
    )
    {
        parent::__construct();
    }

    public function Draw(CanvasInterface $canvas): void
    {
        $frame = $this->GetFrame();
        $points = [
            $frame->getTopLeft(),
            $frame->getTopRight(),
            $frame->getBottomRight(),
            $frame->getBottomLeft(),
        ];
        $canvas->DrawPolygon(
            $points,
            $this->GetFillColor(),
            $this->GetOutlineColor(),
            $this->GetOutlineThickness()
        );
    }

    public function GetFrame(): ?Frame
    {
        $frame = new Frame();
        $frame->topLeft = $this->topLeft;
        $frame->width = $this->width;
        $frame->height = $this->height;
        return $frame;
    }

    public function SetFrame(Frame $frame): void
    {
        $this->topLeft = $frame->topLeft;
        $this->width = $frame->width;
        $this->height = $frame->height;
    }
}