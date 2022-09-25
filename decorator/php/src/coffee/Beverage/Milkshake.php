<?php
declare(strict_types=1);

class Milkshake extends BaseBeverage
{
    private const description = "Milkshake";
    private const cost = 80;

    public function __construct()
    {
        parent::__construct(self::description);
    }

    public function GetCost(): float
    {
        return self::cost;
    }
}