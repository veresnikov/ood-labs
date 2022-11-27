<?php
declare(strict_types=1);

namespace App\Paragraph;

interface ParagraphInterface
{
    public function GetText(): string;

    public function SetText(string $text): void;
}