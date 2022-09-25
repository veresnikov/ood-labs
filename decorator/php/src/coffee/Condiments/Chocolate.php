<?php
declare(strict_types=1);

class Chocolate extends CondimentDecorator
{
    private const CondimentDescription = "Chocolate";

    private const CondimentCost = 10;
    private const MaxWedge = 5;
    private int $chips;

    public function __construct(BeverageInterface $beverage, int $chips)
    {
        parent::__construct(self::CondimentDescription, self::CondimentCost);
        $this->beverage = $beverage;
        if ($chips > self::MaxWedge)
        {
            throw new LogicException("too many chocolate chips");
        }
        $this->chips = $chips;
    }

    protected function GetCondimentDescription(): string
    {
        return parent::GetCondimentDescription() . " " . $this->chips . " chips";
    }

    protected function GetCondimentCost(): float
    {
        return parent::GetCondimentCost() * $this->chips;
    }
}