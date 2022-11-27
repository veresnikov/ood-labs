<?php
declare(strict_types=1);

namespace App\Document;

use App\Command\ChangeDocumentTitleCommand;
use App\Command\DeleteItemCommand;
use App\Command\InsertItemCommand;
use App\Image\Image;
use App\Image\ImageInterface;
use App\Image\ImageNotExistException;
use App\Image\InvalidImageTypeException;
use App\Paragraph\Paragraph;
use App\Paragraph\ParagraphInterface;

class Document implements DocumentInterface
{
    /**
     * @var DocumentItem[]
     */
    private array $items = [];

    private string $title = "";

    public function __construct(private HistoryInterface $history, private SaverInterface $saver)
    {
    }

    public function InsertParagraph(string $text, ?int $position = null): ParagraphInterface
    {
        $paragraph = new Paragraph($text, $this->history);
        $this->history->Execute(new InsertItemCommand($this->items, new DocumentItem($paragraph), $position));
        return $paragraph;
    }

    /**
     * @throws ImageNotExistException
     * @throws InvalidImageTypeException
     */
    public function InsertImage(string $path, int $width, int $height, ?int $position = null): ImageInterface
    {
        $image = new Image($path, $width, $height, $this->history);
        $this->history->Execute(new InsertItemCommand($this->items, new DocumentItem($image), $position));
        return $image;
    }

    public function GetItemsCount(): int
    {
        return count($this->items);
    }

    public function GetItem(int $index): DocumentItem
    {
        if ($this->GetItemsCount() <= $index) {
            throw new \InvalidArgumentException("invalid index " . $index);
        }
        return $this->items[$index];
    }

    public function DeleteItem(int $index): void
    {
        $this->history->Execute(new DeleteItemCommand($this->items, $index));
    }

    public function GetTitle(): string
    {
        return $this->title;
    }

    public function SetTitle(string $text): void
    {
        $this->history->Execute(new ChangeDocumentTitleCommand($this->title, $text));
    }

    public function CanUndo(): bool
    {
        return $this->history->CanUndo();
    }

    public function Undo(): void
    {
        $this->history->Undo();
    }

    public function CanRedo(): bool
    {
        return $this->history->CanRedo();
    }

    public function Redo(): void
    {
        $this->history->Redo();
    }

    public function Save(string $path): void
    {
        $this->saver->Save($this, $path);
    }
}