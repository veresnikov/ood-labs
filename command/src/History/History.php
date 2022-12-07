<?php
declare(strict_types=1);

namespace App\History;

use App\Command\CommandInterface;
use App\Document\HistoryInterface;

class History implements HistoryInterface
{
    /**
     * @var CommandInterface[]
     */
    private array $commands = [];

    private int $currentCommandIndex = 0;

    public function CanUndo(): bool
    {
        return $this->currentCommandIndex > 0;
    }

    public function Undo(): void
    {
        if ($this->CanUndo()) {
            $this->commands[--$this->currentCommandIndex]->Rollback();
        }
    }

    public function CanRedo(): bool
    {
        return $this->currentCommandIndex < count($this->commands);
    }

    public function Redo(): void
    {
        if ($this->CanRedo()) {
            $this->commands[$this->currentCommandIndex++]->Execute();
        }
    }

    public function Execute(CommandInterface $command): void
    {
        $command->Execute();
        $this->commands = array_slice($this->commands, 0, $this->currentCommandIndex);
        $this->commands[] = $command;
        ++$this->currentCommandIndex;
    }
}