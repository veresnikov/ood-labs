<?php
declare(strict_types=1);

namespace Application\ShapeGroup;

use Application\Canvas\RGBAColor;
use Application\Shapes\ShapeInterface;
use Application\Styles\StyleInterface;

class GroupStyle implements StyleInterface
{
    /**
     * @param StyleInterface[] $styles
     */
    public function __construct(
        private array &$styles
    )
    {
    }

    public function IsEnable(): ?bool
    {
        $enable = null;
        foreach ($this->styles as $style) {
            $e = $style->IsEnable();
            if (!$e) {
                return null;
            }
            if (!$enable) {
                $enable = $e;
                continue;
            }
            if ($enable !== $e) {
                return null;
            }
        }
        return $enable;
    }

    public function Enable(): void
    {
        foreach ($this->styles as $style) {
            $style->Enable();
        }
    }

    public function Disable(): void
    {
        foreach ($this->styles as $style) {
            $style->Disable();
        }
    }

    public function GetColor(): ?RGBAColor
    {
        $color = null;
        foreach ($this->styles as $style) {
            $e = $style->GetColor();
            if (!$e) {
                return null;
            }
            if (!$color) {
                $color = $e;
                continue;
            }
            if ($color !== $e) {
                return null;
            }
        }
        return $color;
    }

    public function SetColor(RGBAColor $color): void
    {
        foreach ($this->styles as $style) {
            $style->SetColor($color);
        }
    }
}