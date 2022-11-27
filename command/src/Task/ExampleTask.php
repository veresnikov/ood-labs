<?php
declare(strict_types=1);

namespace App\Task;

use App\Document\Document;
use App\History\History;
use App\Saver\Saver;

class ExampleTask implements TaskInterface
{
    public function Execute(int $argc, array $argv): void
    {
        $doc = new Document(new History(), new Saver());
        $doc->SetTitle("test title");
        $doc->InsertParagraph("test");
        $doc->InsertParagraph("test2");
        $doc->InsertImage("test_data/img.png", 1920, 1080, 1);
        $doc->Save("./output.html");
    }
}