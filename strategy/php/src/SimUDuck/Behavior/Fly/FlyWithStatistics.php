<?php
declare(strict_types=1);

class FlyWithStatistics implements FlyBehaviorInterface
{
    private int $statistic = 0;
    public function Fly(): void
    {
        $this->statistic++;
        echo "I'm fly. My flight number: " . $this->statistic . PHP_EOL;
    }
}