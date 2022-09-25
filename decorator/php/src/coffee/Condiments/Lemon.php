<?php
declare(strict_types=1);

class Lemon extends CondimentDecorator
{
    private const CondimentDescription = "Lemon";

    private const CondimentCost = 20;

    private int $quantity;

    public function __construct(BeverageInterface $beverage, int $quantity = 1)
    {
        parent::__construct(self::CondimentDescription, self::CondimentCost);
        $this->beverage = $beverage;
        $this->quantity = $quantity;
    }

    public function GetCondimentDescription(): string
    {
        return parent::GetCondimentDescription() . " x " . $this->quantity;
    }

    public function GetCondimentCost(): float
    {
        return parent::GetCondimentCost() * $this->quantity;
    }
}