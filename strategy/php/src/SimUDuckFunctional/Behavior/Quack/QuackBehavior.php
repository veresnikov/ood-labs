<?php
declare(strict_types=1);

function Quack(): Closure
{
    return function () {
        echo "Quack Quack!!!" . PHP_EOL;
    };
}
