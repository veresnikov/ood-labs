<?php
declare(strict_types=1);

function Waltz(): Closure
{
    return function () {
        echo "Dance waltz!" . PHP_EOL;
    };
}
