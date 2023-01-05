<?php
declare(strict_types=1);

namespace Application\Shapes\Triangle;

use Application\Canvas\CanvasInterface;
use Application\Canvas\Point;
use Application\Shapes\Base\Shape;
use Application\Shapes\Frame;

class Triangle extends Shape
{
    public function __construct(
        private Point $vertex1,
        private Point $vertex2,
        private Point $vertex3,
    )
    {
        parent::__construct();
    }

    public function Draw(CanvasInterface $canvas): void
    {
        $canvas->DrawPolygon(
            [
                $this->vertex1,
                $this->vertex2,
                $this->vertex3,
            ],
            $this->GetFillColor(),
            $this->GetOutlineColor(),
            $this->GetOutlineThickness()
        );
    }

    public function GetFrame(): ?Frame
    {
        $minX = min($this->vertex1->x, $this->vertex2->x, $this->vertex3->x);
        $minY = min($this->vertex1->y, $this->vertex2->y, $this->vertex3->y);
        $maxX = max($this->vertex1->x, $this->vertex2->x, $this->vertex3->x);
        $maxY = max($this->vertex1->y, $this->vertex2->y, $this->vertex3->y);
        $topLeft = new Point();
        $topLeft->x = $minX;
        $topLeft->y = $minY;
        $frame = new Frame();
        $frame->topLeft = $topLeft;
        $frame->width = $maxX - $minX;
        $frame->height = $maxY - $minY;
        return $frame;
    }

    public function SetFrame(Frame $frame): void
    {
        $current = $this->GetFrame();
        $transformX = $frame->width / $current->width;
        $transformY = $frame->height / $current->height;
        $this->TransformPoint($this->vertex1, $current, $frame, $transformX, $transformY);
        $this->TransformPoint($this->vertex2, $current, $frame, $transformX, $transformY);
        $this->TransformPoint($this->vertex3, $current, $frame, $transformX, $transformY);
    }

    private function TransformPoint(
        Point &$point,
        Frame $current,
        Frame $new,
        float $transformX,
        float $transformY
    ): void
    {
        $point->x = $new->topLeft->x + ($point->x - $current->topLeft->x) * $transformX;
        $point->y = $new->topLeft->y + ($point->y - $current->topLeft->y) * $transformY;
    }
}