<?php
declare(strict_types=1);

class Milkshake extends BeverageVariable
{
    private const Large = "Large";
    private const Medium = "Medium";
    private const Small = "Small";

    private const Portion = [
        self::Large => [
            BeverageVariable::DescriptionField => self::Large,
            BeverageVariable::CostField => 80,
        ],
        self::Medium => [
            BeverageVariable::DescriptionField => self::Medium,
            BeverageVariable::CostField => 60,
        ],
        self::Small => [
            BeverageVariable::DescriptionField => self::Small,
            BeverageVariable::CostField => 50,
        ],
    ];

    private const description = "Milkshake";

    public function __construct(MilkshakeVariant $variant)
    {
        parent::__construct(self::description);
        $this->rules = self::Portion;
        $this->type = $variant->name;
    }
}