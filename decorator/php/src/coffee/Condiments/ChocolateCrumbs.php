<?php
declare(strict_types=1);

class ChocolateCrumbs extends CondimentDecorator
{
    private const CondimentDescription = "Chocolate crumbs";

    private const CondimentCost = 2;

    private float $mass;

    public function __construct(BeverageInterface $beverage, float $mass)
    {
        parent::__construct(self::CondimentDescription, self::CondimentCost);
        $this->beverage = $beverage;
        $this->mass = $mass;
    }

    public function GetCondimentDescription(): string
    {
        return parent::GetCondimentDescription() . " " . $this->mass . "g";
    }

    public function GetCondimentCost(): float
    {
        return parent::GetCondimentCost() * $this->mass;
    }
}