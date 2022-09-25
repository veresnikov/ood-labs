<?php
declare(strict_types=1);

class CoconutFlakes extends CondimentDecorator
{
    private const CondimentDescription = "Coconut flakes";

    private const CondimentCost = 1;

    private float $mass;

    public function __construct(BeverageInterface $beverage, float $mass)
    {
        parent::__construct(self::CondimentDescription, self::CondimentCost);
        $this->beverage = $beverage;
        $this->mass = $mass;
    }

    protected function GetCondimentDescription(): string
    {
        return parent::GetCondimentDescription() . " " . $this->mass . "g";
    }

    protected function GetCondimentCost(): float
    {
        return parent::GetCondimentCost() * $this->mass;
    }
}