<?php
declare(strict_types=1);

class Cappuccino extends BeverageVariable
{
    private const Standard = "Standard";
    private const Double = "Double";

    private const Portion = [
        self::Standard => [
            BeverageVariable::DescriptionField => self::Standard,
            BeverageVariable::CostField => 80,
        ],
        self::Double => [
            BeverageVariable::DescriptionField => self::Double,
            BeverageVariable::CostField => 120,
        ],
    ];

    private const description = "Cappuccino";

    public function __construct(CoffeePortionVariant $portion = CoffeePortionVariant::Double)
    {
        parent::__construct(self::description);
        $this->rules = self::Portion;
        $this->type = $portion->name;
    }
}