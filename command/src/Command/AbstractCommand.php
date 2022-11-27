<?php
declare(strict_types=1);

namespace App\Command;

abstract class AbstractCommand implements CommandInterface
{
    private bool $completed = false;

    public function Execute(): void
    {
        if (!$this->IsCompleted()) {
            $this->DoExecute();
            $this->completed = true;
        }
    }

    public function Rollback(): void
    {
        if ($this->IsCompleted()) {
            $this->DoRollback();
            $this->completed = false;
        }
    }

    protected function IsCompleted(): bool
    {
        return $this->completed;
    }

    abstract protected function DoExecute(): void;

    abstract protected function DoRollback(): void;
}