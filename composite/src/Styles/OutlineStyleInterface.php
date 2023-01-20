<?php
declare(strict_types=1);

namespace App\Styles;
interface OutlineStyleInterface extends StyleInterface
{
    public function GetThickness(): ?float;

    public function SetThickness(float $thickness): void;
}