<?php
declare(strict_types=1);

namespace App\Styles;

use App\Canvas\RGBAColor;

class Style implements StyleInterface
{
    private bool $enabled = false;
    private ?RGBAColor $color = null;

    public function IsEnable(): ?bool
    {
        return $this->enabled;
    }

    public function Enable(): void
    {
        $this->enabled = true;
    }

    public function Disable(): void
    {
        $this->enabled = false;
    }

    public function GetColor(): ?RGBAColor
    {
        return $this->color;
    }

    public function SetColor(RGBAColor $color): void
    {
        $this->color = $color;
    }
}