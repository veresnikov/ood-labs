<?php
declare(strict_types=1);

namespace App\Document;

interface SaverInterface
{
    public function Save(DocumentInterface $document, string $path): void;
}