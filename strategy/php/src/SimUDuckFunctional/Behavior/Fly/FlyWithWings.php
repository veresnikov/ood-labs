<?php
declare(strict_types=1);

function FlyWithWings(): Closure
{
    return function () {
        echo "I'm fly" . PHP_EOL;
    };
}
