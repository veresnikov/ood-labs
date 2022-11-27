<?php
declare(strict_types=1);

namespace App\Command;

use App\Utils\Utils;

class ChangeParagraphTextCommand extends AbstractCommand
{
    public function __construct(private string &$paragraphText, private string $newText)
    {
    }

    protected function DoExecute(): void
    {
        Utils::Swap($this->paragraphText, $this->newText);
    }

    protected function DoRollback(): void
    {
        Utils::Swap($this->newText, $this->paragraphText);
    }
}