<?php
declare(strict_types=1);

namespace App\Document;

use App\Image\ImageInterface;
use App\Paragraph\ParagraphInterface;

class DocumentItem
{
    private ImageInterface|ParagraphInterface $item;

    public function __construct(ImageInterface|ParagraphInterface $item)
    {
        $this->item = $item;
    }

    public function GetImage(): ?ImageInterface
    {
        if ($this->item instanceof ImageInterface) {
            return $this->item;
        }
        return null;
    }

    public function GetParagraph(): ?ParagraphInterface
    {
        if ($this->item instanceof ParagraphInterface) {
            return $this->item;
        }
        return null;
    }
}