<?php
declare(strict_types=1);

namespace App\Menu;

use App\Document\DocumentInterface;
use App\Utils\Utils;

class Menu
{
    private bool $isRunning = false;

    public function __construct(private DocumentInterface $document)
    {
    }

    public function Run($input): void
    {
        $this->isRunning = true;
        while ($command = fgets($input)) {
            $command = str_replace("\n", "", $command);
            try {
                $commandName = $this->GetNextPart($command);
                if (!$commandName) {
                    throw new \RuntimeException("command name can not be null");
                }
                $command = preg_replace("/\s*$commandName\s*/", "", $command, 1);
                $this->Execute($commandName, $command);
            } catch (\Exception $exception) {
                echo $exception->getMessage() . PHP_EOL;
            }
            if (!$this->isRunning) {
                break;
            }
        }
    }

    private function Execute(string $commandName, string $args): void
    {
        switch ($commandName) {
            case "Exit":
                $this->Exit();
                return;
            case "Help":
                $this->Help();
                return;
            case "Save":
                $this->Save($args);
                return;
            case "Undo":
                $this->Undo();
                return;
            case "Redo":
                $this->Redo();
                return;
            case "DeleteItem":
                $this->DeleteItem($args);
                return;
            case "ResizeImage":
                $this->ResizeImage($args);
                return;
            case "ReplaceText":
                $this->ReplaceText($args);
                return;
            case "List":
                $this->List();
                return;
            case "SetTitle":
                $this->SetTitle($args);
                return;
            case "InsertImage":
                $this->InsertImage($args);
                return;
            case "InsertParagraph":
                $this->InsertParagraph($args);
                return;
            default:
                throw new \RuntimeException("unknown command \"$commandName\". Use Help for show command list");
        }
    }

    private function Help(): void
    {
        echo "InsertParagraph {position}|end {text}" . PHP_EOL .
            "InsertImage {position}|end {width} {height} {path}" . PHP_EOL .
            "SetTitle {title}" . PHP_EOL .
            "List" . PHP_EOL .
            "ReplaceText {position} {text}" . PHP_EOL .
            "ResizeImage {position} {width} {height}" . PHP_EOL .
            "DeleteItem {position}" . PHP_EOL .
            "Help" . PHP_EOL .
            "Undo" . PHP_EOL .
            "Redo" . PHP_EOL .
            "Save" . PHP_EOL;
    }

    private function Exit(): void
    {
        $this->isRunning = false;
    }

    private function Save(?string $args): void
    {
        $this->AssertArgs($args);
        $path = $this->GetNextPart($args);
        $this->document->Save($path);
    }

    private function Undo(): void
    {
        if (!$this->document->CanUndo()) {
            throw new \RuntimeException("can not undo");
        }
        $this->document->Undo();
    }

    private function Redo(): void
    {
        if (!$this->document->CanRedo()) {
            throw new \RuntimeException("can not redo");
        }
        $this->document->Redo();
    }

    private function DeleteItem(?string $args): void
    {
        $this->AssertArgs($args);
        $position = $this->ExtractPosition($args);
        if (!$position) {
            throw new \RuntimeException("position can not be null");
        }
        $this->document->DeleteItem($position);
    }

    private function ResizeImage(?string $args): void
    {
        $this->AssertArgs($args);
        $position = $this->ExtractPosition($args);
        if (!$position) {
            throw new \RuntimeException("position can not be null");
        }
        $width = $this->ExtractNumber($args);
        $height = $this->ExtractNumber($args);
        $image = $this->document->GetItem($position)->GetImage();
        if (!$image) {
            throw new \RuntimeException("item is not image");
        }
        $image->Resize($width, $height);
    }

    private function List(): void
    {
        echo "Title: " . $this->document->GetTitle() . PHP_EOL;
        for ($index = 0; $index < $this->document->GetItemsCount(); $index++) {
            $item = $this->document->GetItem($index);
            $str = "";
            if ($image = $item->GetImage()) {
                $str = "Image: " . $image->GetPath() . " " . $image->GetWidth() . " x " . $image->GetHeight();
            } elseif ($paragraph = $item->GetParagraph()) {
                $str = "Paragraph: " . $paragraph->GetText();
            }
            echo $str . PHP_EOL;
        }
    }

    private function SetTitle(?string $args): void
    {
        $this->AssertArgs($args);
        $this->document->SetTitle($args);
    }

    private function ReplaceText(?string $args): void
    {
        $this->AssertArgs($args);
        $position = $this->ExtractPosition($args);
        if (!$position) {
            throw new \RuntimeException("position can not be null");
        }
        if ($args === "") {
            throw new \RuntimeException("text can not be empty");
        }
        $paragraph = $this->document->GetItem($position)->GetParagraph();
        if ($paragraph) {
            throw new \RuntimeException("item is not paragraph");
        }
        $paragraph->SetText($args);
    }

    private function InsertImage(?string $args): void
    {
        $this->AssertArgs($args);
        $position = $this->ExtractPosition($args);
        $width = $this->ExtractNumber($args);
        $height = $this->ExtractNumber($args);
        if ($args === "") {
            throw new \RuntimeException("path can not be empty");
        }
        $this->document->InsertImage($args, $width, $height, $position);
    }

    private function InsertParagraph(?string $args): void
    {
        $this->AssertArgs($args);
        $position = $this->ExtractPosition($args);
        if ($args === "") {
            throw new \RuntimeException("text can not be empty");
        }
        $this->document->InsertParagraph($args, $position);
    }

    private function GetNextPart(string $command): ?string
    {
        if (Utils::PregMatch("/\S+/", $command, $matches) != 0) {
            return $matches[0];
        }
        return null;
    }

    private function ConvertPosition(string $position): ?int
    {
        if (Utils::PregMatch("/end|\d+/", $position, $matches) == 0) {
            throw new \RuntimeException("failed to parse position: " . $position);
        }
        if ($matches[0] === "end") {
            return null;
        }
        return intval($matches[0]);
    }

    private function IsNumber(string $number): bool
    {
        return Utils::PregMatch("/\d+/", $number, $matches) != 0;
    }

    private function AssertArgs(?string $args): void
    {
        if (!$args) {
            throw new \RuntimeException("arguments can not be null or empty");
        }
    }

    private function ExtractPosition(string &$args): ?int
    {
        $strPosition = $this->GetNextPart($args);
        $args = preg_replace("/\s*$strPosition\s*/", "", $args, 1);
        return $this->ConvertPosition($strPosition);
    }

    private function ExtractNumber(string &$args): int
    {
        $strNumber = $this->GetNextPart($args);
        $args = preg_replace("/\s*$strNumber\s*/", "", $args, 1);
        if (!$strNumber) {
            throw new \RuntimeException("number can not be null");
        }
        if (!$this->IsNumber($strNumber)) {
            throw new \RuntimeException("invalid number: " . $strNumber);
        }
        return intval($strNumber);
    }
}