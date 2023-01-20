<?php
declare(strict_types=1);

namespace App\Styles;

use App\Canvas\RGBAColor;

interface StyleInterface
{
    public function IsEnable(): ?bool;
    public function Enable(): void;
    public function Disable(): void;
    public function GetColor(): ?RGBAColor;
    public function SetColor(RGBAColor $color): void;
}