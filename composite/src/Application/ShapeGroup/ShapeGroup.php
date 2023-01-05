<?php
declare(strict_types=1);

namespace Application\ShapeGroup;

use App\Utils\Utils;
use Application\Canvas\CanvasInterface;
use Application\Canvas\Point;
use Application\Shapes\Frame;
use Application\Shapes\ShapeInterface;
use Application\Styles\OutlineStyleInterface;
use Application\Styles\StyleInterface;

class ShapeGroup implements ShapeGroupInterface
{
    /**
     * @var ShapeInterface[]
     */
    private array $shapes = [];

    public function Draw(CanvasInterface $canvas): void
    {
        foreach ($this->shapes as $shape) {
            $shape->Draw($canvas);
        }
    }

    public function GetShapesCount(): int
    {
        return count($this->shapes);
    }

    public function GetShape(int $index): ShapeInterface
    {
        $this->AssertIndex($index);
        return $this->shapes[$index];
    }

    public function Insert(ShapeInterface $shape, ?int $index = null): void
    {
        if ($index) {
            $this->AssertIndex($index);
            Utils::ArrayEmplace($this->shapes, $index, $shape);
        } else {
            $this->shapes[] = $shape;
        }
    }

    public function Remove(int $index): void
    {
        $this->AssertIndex($index);
        unset($this->shapes[$index]);
        $this->shapes = array_values($this->shapes);
    }

    public function GetFrame(): ?Frame
    {
        if ($this->GetShapesCount() === 0) {
            return null;
        }
        $minX = PHP_FLOAT_MAX;
        $minY = PHP_FLOAT_MAX;
        $maxX = PHP_FLOAT_MIN;
        $maxY = PHP_FLOAT_MIN;
        foreach ($this->shapes as $shape) {
            $frame = $shape->GetFrame();
            if (!$frame) {
                return null;
            }
            $minX = min($minX, $frame->getTopLeft()->x);
            $minY = min($minY, $frame->getTopRight()->y);
            $maxX = max($maxX, $frame->getBottomRight()->x);
            $maxY = max($maxY, $frame->getBottomLeft()->y);
        }
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
        if (!$current) {
            return;
        }
        $transformX = $frame->width / $current->width;
        $transformY = $frame->height / $current->height;
        foreach ($this->shapes as $shape) {
            $shapeFrame = $shape->GetFrame();
            $newTopLeft = new Point();
            $newTopLeft->x = $frame->topLeft->x + ($shapeFrame->getTopLeft()->x - $current->topLeft->x) * $transformX;
            $newTopLeft->y = $frame->topLeft->y + ($shapeFrame->getTopLeft()->y - $current->topLeft->y) * $transformY;
            $newFrame = new Frame();
            $newTopLeft->wight = $shapeFrame->width * $transformX;
            $newTopLeft->height = $shapeFrame->height * $transformY;
            $newFrame->topLeft = $newTopLeft;
            $shape->SetFrame($newFrame);
        }
    }

    public function GetOutlineStyle(): OutlineStyleInterface
    {
        // TODO: Implement GetOutlineStyle() method.
    }

    public function SetOutlineStyle(OutlineStyleInterface $outlineStyle): void
    {
        // TODO: Implement SetOutlineStyle() method.
    }

    public function GetFillStyle(): StyleInterface
    {
        // TODO: Implement GetFillStyle() method.
    }

    public function SetFillStyle(StyleInterface $fillStyle): void
    {
        // TODO: Implement SetFillStyle() method.
    }

    public function GetGroup(): ?ShapeGroupInterface
    {
        return $this;
    }

    private function AssertIndex(int $index): void
    {
        if ($index >= $this->GetShapesCount()) {
            throw new \OutOfRangeException("index out of range");
        }
    }
}