<?php
declare(strict_types=1);

abstract class Duck
{
    public function __construct(
        private FlyBehaviorInterface   $flyBehavior,
        private QuackBehaviorInterface $quackBehavior,
        private DanceBehaviorInterface $danceBehavior,
    )
    {
    }

    public function Quack(): void
    {
        $this->quackBehavior->Quack();
    }

    public function Fly(): void
    {
        $this->flyBehavior->Fly();
    }

    public function Dance(): void
    {
        $this->danceBehavior->Dance();
    }

    public function Swim(): void
    {
        echo "I'm swimming" . PHP_EOL;
    }

    public function setFlyBehavior(FlyBehaviorInterface $flyBehavior): void
    {
        $this->flyBehavior = $flyBehavior;
    }

    public abstract function Display(): void;
}