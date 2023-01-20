<?php
declare(strict_types=1);

namespace App\Shapes;

use App\ShapeGroup\ShapeGroupInterface;
use App\Styles\OutlineStyleInterface;
use App\Styles\StyleInterface;

interface ShapeInterface extends DrawableShapeInterface
{
    public function GetFrame(): ?Frame;

    public function SetFrame(Frame $frame): void;

    public function GetOutlineStyle(): OutlineStyleInterface;

    public function GetFillStyle(): StyleInterface;

    public function GetGroup(): ?ShapeGroupInterface;
}