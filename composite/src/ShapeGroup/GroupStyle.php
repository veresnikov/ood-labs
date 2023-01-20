<?php
declare(strict_types=1);

namespace App\ShapeGroup;

use App\Canvas\RGBAColor;
use App\Styles\StyleInterface;
use Closure;

class GroupStyle implements StyleInterface
{
    /**
     * @param Closure $callback
     */
    public function __construct(
        private Closure $callback
    )
    {
    }

    public function IsEnable(): ?bool
    {
        $enable = null;
        foreach ($this->GetStyles() as $style) {
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
        foreach ($this->GetStyles() as $style) {
            $style->Enable();
        }
    }

    public function Disable(): void
    {
        foreach ($this->GetStyles() as $style) {
            $style->Disable();
        }
    }

    public function GetColor(): ?RGBAColor
    {
        $color = null;
        foreach ($this->GetStyles() as $style) {
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
        foreach ($this->GetStyles() as $style) {
            $style->SetColor($color);
        }
    }

    /**
     * @return StyleInterface[]
     */
    private function GetStyles(): array
    {
        return call_user_func($this->callback);
    }
}