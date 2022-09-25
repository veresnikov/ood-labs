<?php
declare(strict_types=1);

class Latte extends BaseBeverage
{
    private const description = "Latte";
    private const cost = 90;

    public function __construct()
    {
        parent::__construct(self::description);
    }

    public function GetCost(): float
    {
        return self::cost;
    }
}