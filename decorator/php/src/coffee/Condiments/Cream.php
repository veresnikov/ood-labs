<?php
declare(strict_types=1);

class Cream extends CondimentDecorator
{
    private const CondimentDescription = "Cream";

    private const CondimentCost = 25;

    public function __construct(BeverageInterface $beverage)
    {
        parent::__construct(self::CondimentDescription, self::CondimentCost);
        $this->beverage = $beverage;
    }
}