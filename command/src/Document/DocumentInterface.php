<?php
declare(strict_types=1);

namespace App\Document;

use App\Image\ImageInterface;
use App\Paragraph\ParagraphInterface;

interface DocumentInterface
{
    public function InsertParagraph(string $text, ?int $position = null): ParagraphInterface;

    public function InsertImage(string $path, int $width, int $height, ?int $position = null): ImageInterface;

    public function GetItemsCount(): int;

    public function GetItem(int $index): DocumentItem;

    public function DeleteItem(int $index): void;

    public function GetTitle(): string;

    public function SetTitle(string $text): void;

    public function CanUndo(): bool;

    public function Undo(): void;

    public function CanRedo(): bool;

    public function Redo(): void;

    public function Save(string $path): void;
}