<?php
declare(strict_types=1);

namespace App\Task;

use App\Document\Document;
use App\History\History;
use App\Menu\Menu;
use App\Saver\Saver;

class ExampleTask implements TaskInterface
{
    public function Execute(int $argc, array $argv): void
    {
        $menu = new Menu(new Document(new History(), new Saver()));
        $menu->Run(STDIN);
    }
}