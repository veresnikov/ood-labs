<?php
declare(strict_types=1);

class RedheadDuck extends Duck
{
    public function __construct()
    {
        parent::__construct(FlyWithWings(), Quack(), Minuet());
    }

    public function Display(): void
    {
        echo "I'm redhead duck" . PHP_EOL;
    }
}