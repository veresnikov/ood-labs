<?php
declare(strict_types=1);

class MallardDuck extends Duck
{
    public function __construct()
    {
        parent::__construct(FlyWithWings(), Quack(), Waltz());
    }

    public function Display(): void
    {
        echo "I'm mallard duck" . PHP_EOL;
    }
}