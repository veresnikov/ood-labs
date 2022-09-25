<?php
declare(strict_types=1);

class Tea extends BeverageVariable
{
    private const Oolong = "Oolong";
    private const Puerh = "Puerh";
    private const Hibiscus = "Hibiscus";
    private const Black = "Black";

    private const Sort = [
        self::Oolong => [
            BeverageVariable::DescriptionField => self::Oolong,
        ],
        self::Puerh => [
            BeverageVariable::DescriptionField => self::Puerh,
        ],
        self::Hibiscus => [
            BeverageVariable::DescriptionField => self::Hibiscus,
        ],
        self::Black => [
            BeverageVariable::DescriptionField => self::Black,
        ],
    ];

    private const description = "Tea";
    private const cost = 30;

    public function __construct(TeaSortVariant $sort)
    {
        parent::__construct(self::description);
        $this->rules = self::Sort;
        $this->type = $sort->name;
    }

    public function GetCost(): float
    {
        return self::cost;
    }
}