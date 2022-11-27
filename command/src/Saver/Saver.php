<?php
declare(strict_types=1);

namespace App\Saver;

use App\Document\DocumentInterface;
use App\Document\SaverInterface;
use App\Image\ImageInterface;
use App\Paragraph\ParagraphInterface;

class Saver implements SaverInterface
{
    public function Save(DocumentInterface $document, string $path): void
    {
        $output = fopen($path, "w");
        if (!$output) {
            throw new \RuntimeException("Failed to open output file");
        }
        $this->WriteTitle($document, $output);
        $this->WriteBody($document, $output);
        $this->WriteFooter($output);
        if (!fclose($output)) {
            throw new \RuntimeException("Failed to close output file");
        }
    }

    private function WriteTitle(DocumentInterface $document, $output): void
    {
        $title = $document->GetTitle();
        $result = fwrite($output, "
        <html>
            <head>
                <title>$title</title>
            </head>
            <body>
                <h1>$title</h1>
        ");
        if (!$result) {
            throw new \RuntimeException("Failed write title to output file");
        }
    }

    private function WriteBody(DocumentInterface $document, $output): void
    {
        for ($index = 0; $index < $document->GetItemsCount(); $index++) {
            $item = $document->GetItem($index);
            if ($item->GetImage()) {
                $this->WriteImage($item->GetImage(), $output);
                continue;
            }
            if ($item->GetParagraph()) {
                $this->WriteParagraph($item->GetParagraph(), $output);
            }
        }
    }

    private function WriteImage(ImageInterface $image, $output): void
    {
        $path = $image->GetPath();
        $width = $image->GetWidth();
        $height = $image->GetHeight();
        $result = fwrite($output, "
            <img src='$path' width='$width' height='$height' />
        ");
        if (!$result) {
            throw new \RuntimeException("Failed write image to output file");
        }
    }

    private function WriteParagraph(ParagraphInterface $paragraph, $output): void
    {
        $text = htmlspecialchars($paragraph->GetText());
        $result = fwrite($output, "
            <p>$text</p>
        ");
        if (!$result) {
            throw new \RuntimeException("Failed write paragraph to output file");
        }
    }

    private function WriteFooter($output): void
    {
        $result = fwrite($output, "
            </body>
        </html>
        ");
        if (!$result) {
            throw new \RuntimeException("Failed write footer to output file");
        }
    }
}