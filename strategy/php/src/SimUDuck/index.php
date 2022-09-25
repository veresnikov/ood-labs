<?php
declare(strict_types=1);
header("Content-Type: text/plain");
include_once 'includes.php';

function PlayWithDuck(Duck $duck): void
{
    $duck->Display();
    $duck->Fly();
    $duck->Quack();
    $duck->Swim();
    $duck->Dance();
    echo PHP_EOL;
}

$mallardDuck = new MallardDuck();
$redheadDuck = new RedheadDuck();
$decoyDuck = new DecoyDuck();
$rubberDuck = new RubberDuck();
$modelDuck = new ModelDuck();

PlayWithDuck($mallardDuck);
PlayWithDuck($redheadDuck);
PlayWithDuck($decoyDuck);
PlayWithDuck($rubberDuck);
PlayWithDuck($modelDuck);
$modelDuck->setFlyBehavior(new FlyWithWings());
PlayWithDuck($modelDuck);
$modelDuck->setFlyBehavior(new FlyWithStatistics());

PlayWithDuck($mallardDuck);
PlayWithDuck($redheadDuck);
PlayWithDuck($redheadDuck);
PlayWithDuck($modelDuck);