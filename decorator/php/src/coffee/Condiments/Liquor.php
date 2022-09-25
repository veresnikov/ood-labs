<?php
declare(strict_types=1);

class Liquor extends CondimentDecorator
{
    public const Walnut = "Walnut";
    public const Chocolate = "Chocolate";
    private const DescriptionField = "Description";
    private const Cost = 50;

    private const SyrupParams = [
        self::Walnut => [
            self::DescriptionField => self::Walnut,
        ],
        self::Chocolate => [
            self::DescriptionField => self::Chocolate,
        ]
    ];

    public function __construct(BeverageInterface $beverage, LiquorType $type)
    {
        $description = self::SyrupParams[$type->name][self::DescriptionField];
        parent::__construct($description, self::Cost);
        $this->beverage = $beverage;
    }

    protected function GetCondimentDescription(): string
    {
        return parent::GetCondimentDescription() . " liquor";
    }
}