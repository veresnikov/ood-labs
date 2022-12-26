<?php
declare(strict_types=1);

namespace App\Command;

use App\Document\DocumentItem;
use App\Utils\Utils;

class DeleteItemCommand extends AbstractCommand
{
    private DocumentItem $deletedItem;

    /**
     * @param DocumentItem[] $items
     * @param int $index
     */
    public function __construct(private array &$items, private int $index)
    {
    }

    protected function DoExecute(): void
    {
        if (count($this->items) <= $this->index) {
            throw new \InvalidArgumentException("invalid index " . $this->index);
        }
        $this->deletedItem = &$this->items[$this->index];
        unset($this->items[$this->index]);
        $this->items = array_values($this->items);
    }

    protected function DoRollback(): void
    {
        Utils::ArrayEmplace($this->items, $this->index, $this->deletedItem);
    }
}