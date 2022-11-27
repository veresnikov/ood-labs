<?php
declare(strict_types=1);

namespace App\Paragraph;

use App\Command\ChangeParagraphTextCommand;
use App\Document\HistoryInterface;

class Paragraph implements ParagraphInterface
{
    public function __construct(private string $text, private HistoryInterface $history)
    {
    }

    public function GetText(): string
    {
        return $this->text;
    }

    public function SetText(string $text): void
    {
        $this->history->Execute(new ChangeParagraphTextCommand($this->text, $text));
    }
}