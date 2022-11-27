<?php
declare(strict_types=1);

namespace App\Command;

use App\Utils\Utils;

class ResizeImageCommand extends AbstractCommand
{
    public function __construct(private int &$imageWidth, private int &$imageHeight, private int $newWidth, private int $newHeight)
    {
    }

    protected function DoExecute(): void
    {
        Utils::Swap($this->imageWidth, $this->newWidth);
        Utils::Swap($this->imageHeight, $this->newHeight);
    }

    protected function DoRollback(): void
    {
        Utils::Swap($this->newWidth, $this->imageWidth);
        Utils::Swap($this->newHeight, $this->imageHeight);
    }
}