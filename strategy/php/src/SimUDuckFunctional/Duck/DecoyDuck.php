<?php
declare(strict_types=1);

class DecoyDuck extends Duck
{
    public function __construct()
    {
        parent::__construct(FlyNoWay(), MuteQuack(), NoDance());
    }

    public function Display(): void
    {
        echo "I'm decoy duck" . PHP_EOL;
    }
}