<?php
declare(strict_types=1);

class Latte extends BeverageVariable
{
    private const Standard = "Standard";
    private const Double = "Double";

    private const Portion = [
        self::Standard => [
            BeverageVariable::DescriptionField => self::Standard,
            BeverageVariable::CostField => 90,
        ],
        self::Double => [
            BeverageVariable::DescriptionField => self::Double,
            BeverageVariable::CostField => 130,
        ],
    ];

    private const description = "Latte";

    public function __construct(CoffeePortionVariant $portion)
    {
        parent::__construct(self::description);
        $this->rules = self::Portion;
        $this->type = $portion->name;
    }
}