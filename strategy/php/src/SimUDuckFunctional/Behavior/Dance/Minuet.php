<?php
declare(strict_types=1);

function Minuet(): Closure
{
    return function () {
        echo "Dance minuet!" . PHP_EOL;
    };
}
