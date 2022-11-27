<?php
declare(strict_types=1);

namespace App\Image;

interface ImageInterface
{
    public function GetPath(): string;

    public function GetWidth(): int;

    public function GetHeight(): int;

    public function Resize(int $width, int $height): void;
}