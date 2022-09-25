<?php
declare(strict_types=1);

function FlyWithStatistics(): Closure
{
    $statistics = 0;
    return function () use (&$statistics) {
        $statistics++;
        echo "I'm fly. My flight number: " . $statistics . PHP_EOL;
    };
}
