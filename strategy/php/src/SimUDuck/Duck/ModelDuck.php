<?php
declare(strict_types=1);

class ModelDuck extends Duck
{
    public function __construct()
    {
        parent::__construct(new FlyNoWay(), new QuackBehavior(), new NoDance());
    }

    public function Display(): void
    {
        echo "I'm model duck" . PHP_EOL;
    }
}