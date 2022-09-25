<?php
declare(strict_types=1);

class QuackBehavior implements QuackBehaviorInterface
{
    public function Quack(): void
    {
        echo "Quack Quack!!!" . PHP_EOL;
    }
}