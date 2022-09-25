<?php
declare(strict_types=1);

class Coffee extends BaseBeverage
{
    private const description = "Coffee";
    private const cost = 60;

    public function __construct()
    {
        parent::__construct(self::description);
    }

    public function GetCost(): float
    {
        return self::cost;
    }
}