<?php
declare(strict_types=1);

class Waltz implements DanceBehaviorInterface
{

    public function Dance(): void
    {
        echo "Dance waltz!" . PHP_EOL;
    }
}