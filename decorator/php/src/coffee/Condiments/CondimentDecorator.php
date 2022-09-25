<?php
declare(strict_types=1);

class CondimentDecorator implements BeverageInterface
{
    protected BeverageInterface $beverage;

    public function __construct(
        private string $condimentDescription,
        private float  $condimentCost,
    )
    {
    }

    public function GetDescription(): string
    {
        return $this->beverage->GetDescription() . " " . $this->GetCondimentDescription();
    }

    public function GetCost(): float
    {
        return $this->beverage->GetCost() + $this->GetCondimentCost();
    }

    public function GetCondimentDescription(): string
    {
        return $this->condimentDescription;
    }

    public function GetCondimentCost(): float
    {
        return $this->condimentCost;
    }
}