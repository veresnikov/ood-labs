<?php
declare(strict_types=1);
header("Content-Type: text/plain");
include_once 'includes.php';

function PrintInfo(BeverageInterface $beverage): void
{
    echo $beverage->GetDescription() . PHP_EOL;
    echo $beverage->GetCost() . PHP_EOL;
}

$tea = new Tea();

PrintInfo($tea);
