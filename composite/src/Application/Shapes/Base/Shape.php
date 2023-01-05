<?php
declare(strict_types=1);

namespace Application\Shapes\Base;

use Application\Canvas\RGBAColor;
use Application\ShapeGroup\ShapeGroupInterface;
use Application\Shapes\ShapeInterface;
use Application\Styles\OutlineStyle;
use Application\Styles\OutlineStyleInterface;
use Application\Styles\Style;
use Application\Styles\StyleInterface;

abstract class Shape implements ShapeInterface
{
    private OutlineStyleInterface $outlineStyle;

    private StyleInterface $fillStyle;

    public function __construct()
    {
        $this->outlineStyle = new OutlineStyle();
        $this->fillStyle = new Style();
    }

    final public function GetOutlineStyle(): OutlineStyleInterface
    {
        return $this->outlineStyle;
    }

    final public function SetOutlineStyle(OutlineStyleInterface $outlineStyle): void
    {
        $this->outlineStyle = $outlineStyle;
    }

    final public function GetFillStyle(): StyleInterface
    {
        return $this->fillStyle;
    }

    final public function SetFillStyle(StyleInterface $fillStyle): void
    {
        $this->fillStyle = $fillStyle;
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