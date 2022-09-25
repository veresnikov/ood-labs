<?php
declare(strict_types=1);

abstract class Duck
{
    public function __construct(
        private Closure $flyBehavior,
        private Closure $quackBehavior,
        private Closure $danceBehavior,
    )
    {
    }

    public function Quack(): void
    {
        call_user_func($this->quackBehavior);
    }

    public function Fly(): void
    {
        call_user_func($this->flyBehavior);
    }

    public function Dance(): void
    {
        call_user_func($this->danceBehavior);
    }

    public function Swim(): void
    {
        echo "I'm swimming" . PHP_EOL;
    }

    public function setFlyBehavior(Closure $flyBehavior): void
    {
        $this->flyBehavior = $flyBehavior;
    }

    public abstract function Display(): void;
}