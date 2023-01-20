<?php
declare(strict_types=1);

namespace App\Shapes\Base;

use App\Canvas\RGBAColor;
use App\ShapeGroup\ShapeGroupInterface;
use App\Shapes\ShapeInterface;
use App\Styles\OutlineStyle;
use App\Styles\OutlineStyleInterface;
use App\Styles\Style;
use App\Styles\StyleInterface;

abstract class Shape implements ShapeInterface
{
    private OutlineStyleInterface $outlineStyle;

    private StyleInterface $fillStyle;

    public function __construct()
    {
        $this->outlineStyle = new OutlineStyle();
        $this->fillStyle = new Style();
    }

    final public function &GetOutlineStyle(): OutlineStyleInterface
    {
        return $this->outlineStyle;
    }

    final public function &GetFillStyle(): StyleInterface
    {
        return $this->fillStyle;
    }

    public function GetGroup(): ?ShapeGroupInterface
    {
        return null;
    }

    final protected function GetOutlineColor(): ?RGBAColor
    {
        if ($this->outlineStyle->IsEnable()) {
            return $this->outlineStyle->GetColor();
        }
        return null;
    }

    final protected function GetOutlineThickness(): ?float
    {
        if ($this->outlineStyle->IsEnable()) {
            return $this->outlineStyle->GetThickness();
        }
        return null;
    }

    final protected function GetFillColor(): ?RGBAColor
    {
        if ($this->fillStyle->IsEnable()) {
            return $this->fillStyle->GetColor();
        }
        return null;
    }
}