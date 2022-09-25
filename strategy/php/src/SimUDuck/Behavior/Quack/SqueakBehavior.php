<?php
declare(strict_types=1);

class SqueakBehavior implements QuackBehaviorInterface
{
    public function Quack(): void
    {
        echo "Squeak!!!" . PHP_EOL;
    }
}