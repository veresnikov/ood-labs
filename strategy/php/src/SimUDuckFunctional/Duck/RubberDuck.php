<?php
declare(strict_types=1);

class RubberDuck extends Duck
{
    public function __construct()
    {
        parent::__construct(FlyNoWay(), Squeak(), NoDance());
    }

    public function Display(): void
    {
        echo "I'm rubber duck" . PHP_EOL;
    }
}