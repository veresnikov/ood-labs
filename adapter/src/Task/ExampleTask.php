<?php
declare(strict_types=1);

namespace App\Task;

class ExampleTask implements TaskInterface
{

    public function Execute(int $argc, array $argv): void
    {
        echo "Hello world task!" . PHP_EOL;
    }
}