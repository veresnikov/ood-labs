<?php
declare(strict_types=1);

namespace App\Document;

use App\Command\CommandInterface;

interface HistoryInterface
{
    public function CanUndo(): bool;

    public function Undo(): void;

    public function CanRedo(): bool;

    public function Redo(): void;

    public function Execute(CommandInterface $command): void;
}