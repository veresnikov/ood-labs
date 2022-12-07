<?php
declare(strict_types=1);

namespace App\Command;

use App\Document\DocumentItem;
use App\Utils\Utils;

class InsertItemCommand extends AbstractCommand
{
    /**
     * @param DocumentItem[] $items
     * @param DocumentItem $newItem
     * @param int|null $index
     */
    public function __construct(private array &$items, private DocumentItem $newItem, private ?int $index)
    {
    }

    protected function DoExecute(): void
    {
        if ($this->index !== null) {
            Utils::ArrayEmplace($this->items, $this->index, $this->newItem);
            return;
        }
        $this->items[] = $this->newItem;
    }

    protected function DoRollback(): void
    {
        if ($this->index !== null) {
            unset($this->items[$this->index]);
            $this->items = array_values($this->items);
            return;
        }
        array_pop($this->items);
    }
}