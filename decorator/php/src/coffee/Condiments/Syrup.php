<?php
declare(strict_types=1);

class Syrup extends CondimentDecorator
{
    public const Chocolate = "Chocolate";
    public const Maple = "Maple";
    private const DescriptionField = "Description";
    private const Cost = 15;

    private const SyrupParams = [
        self::Chocolate => [
            self::DescriptionField => self::Chocolate,
        ],
        self::Maple => [
            self::DescriptionField => self::Maple,
        ]
    ];

    public function __construct(BeverageInterface $beverage, SyrupType $type)
    {
        $description = self::SyrupParams[$type->name][self::DescriptionField];
        parent::__construct($description, self::Cost);
        $this->beverage = $beverage;
    }

    protected function GetCondimentDescription(): string
    {
        return parent::GetCondimentDescription() . " syrup";
    }
}