<?php
declare(strict_types=1);

class FlyWithWings implements FlyBehaviorInterface
{

    public function Fly(): void
    {
        echo "I'm fly" . PHP_EOL;
    }
}