<?php
declare(strict_types=1);

class Syrup extends CondimentDecorator
{
    public const Chocolate = "Chocolate";
    public const Maple = "Maple";
    private const DescriptionField = "Description";
    private const CostField = "Cost";
    private const Cost = 15;

    private const SyrupParams = [
        self::Chocolate => [
            self::DescriptionField => self::Chocolate,
            self::CostField => self::Cost,
        ],
        self::Maple => [
            self::DescriptionField => self::Maple,
            self::CostField => self::Cost,
        ]
    ];

    public function __construct(BeverageInterface $beverage, SyrupType $type)
    {
        $description = self::SyrupParams[$type->name][self::DescriptionField];
        $cost = self::SyrupParams[$type->name][self::CostField];
        parent::__construct($description, $cost);
        $this->beverage = $beverage;
    }

    public function GetCondimentDescription(): string
    {
        return parent::GetCondimentDescription() . " syrup";
    }
}