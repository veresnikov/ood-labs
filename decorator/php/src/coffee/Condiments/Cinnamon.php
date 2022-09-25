<?php
declare(strict_types=1);

class Cinnamon extends CondimentDecorator
{
    private const CondimentDescription = "Cinnamon";

    private const CondimentCost = 20;

    public function __construct(BeverageInterface $beverage)
    {
        parent::__construct(self::CondimentDescription, self::CondimentCost);
        $this->beverage = $beverage;
    }
}