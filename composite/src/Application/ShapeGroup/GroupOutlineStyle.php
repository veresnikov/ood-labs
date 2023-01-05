<?php
declare(strict_types=1);

namespace Application\ShapeGroup;

use Application\Canvas\RGBAColor;
use Application\Styles\OutlineStyleInterface;

class GroupOutlineStyle implements OutlineStyleInterface
{

    public function GetThickness(): ?float
    {
        // TODO: Implement GetThickness() method.
    }

    public function SetThickness(float $thickness): void
    {
        // TODO: Implement SetThickness() method.
    }

    public function IsEnable(): ?bool
    {
        // TODO: Implement IsEnable() method.
    }

    public function Enable(): void
    {
        // TODO: Implement Enable() method.
    }

    public function Disable(): void
    {
        // TODO: Implement Disable() method.
    }

    public function GetColor(): ?RGBAColor
    {
        // TODO: Implement GetColor() method.
    }

    public function SetColor(RGBAColor $color): void
    {
        // TODO: Implement SetColor() method.
    }
}