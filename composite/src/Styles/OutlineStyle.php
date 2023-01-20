<?php
declare(strict_types=1);

namespace App\Styles;

class OutlineStyle extends Style implements OutlineStyleInterface
{
    private float $thickness = 1;
    public function GetThickness(): ?float
    {
        return $this->thickness;
    }

    public function SetThickness(float $thickness): void
    {
        $this->thickness = $thickness;
    }
}