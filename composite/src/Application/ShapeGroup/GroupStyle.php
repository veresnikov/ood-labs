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
        foreach ($this->styles as $shape) {
            $e = $shape->IsEnable();
            if (!$e) {
                return null;
            }
            if ($enable)
            {
                $enable = $e;
                continue;
            }
            if ($enable !== $e)
            {
                return null;
            }
        }
        return $enable;
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