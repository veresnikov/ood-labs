<?php
declare(strict_types=1);

class Minuet implements DanceBehaviorInterface
{
    public function Dance(): void
    {
        echo "Dance minuet!" . PHP_EOL;
    }
}