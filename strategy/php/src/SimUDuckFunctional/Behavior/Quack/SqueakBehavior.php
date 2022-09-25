<?php
declare(strict_types=1);

function Squeak(): Closure
{
    return function () {
        echo "Squeak!!!" . PHP_EOL;
    };
}
