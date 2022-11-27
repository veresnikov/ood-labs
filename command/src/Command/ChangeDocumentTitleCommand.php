<?php
declare(strict_types=1);

namespace App\Command;

use App\Utils\Utils;

class ChangeDocumentTitleCommand extends AbstractCommand
{
    public function __construct(private string &$documentTitle, private string $newTitle)
    {
    }

    protected function DoExecute(): void
    {
        Utils::Swap($this->documentTitle, $this->newTitle);
    }

    protected function DoRollback(): void
    {
        Utils::Swap($this->newTitle, $this->documentTitle);
    }
}