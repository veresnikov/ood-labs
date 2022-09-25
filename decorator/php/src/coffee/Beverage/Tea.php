<?php
declare(strict_types=1);

class Tea extends BaseBeverage
{
    private const description = "Tea";
    private const cost = 30;

    public function __construct()
    {
        parent::__construct(self::description);
    }

    public function GetCost(): float
    {
        return self::cost;
    }
}