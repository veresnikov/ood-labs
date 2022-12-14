<?php
declare(strict_types=1);

namespace Application\Shapes;

use Application\ShapeGroup\ShapeGroupInterface;
use Application\Styles\OutlineStyleInterface;
use Application\Styles\StyleInterface;

interface ShapeInterface extends DrawableShapeInterface
{
    public function GetFrame(): ?Frame;

    public function SetFrame(Frame $frame): void;

    public function GetOutlineStyle(): OutlineStyleInterface;

    public function SetOutlineStyle(OutlineStyleInterface $outlineStyle): void;

    public function GetFillStyle(): StyleInterface;

    public function SetFillStyle(StyleInterface $fillStyle): void;

    public function GetGroup(): ?ShapeGroupInterface;
}