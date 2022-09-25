<?php
declare(strict_types=1);

class IceCubes extends CondimentDecorator
{
    public const Dry = "Dry";
    public const Water = "Water";
    private const DescriptionField = "Description";
    private const CostField = "Cost";

    private const IceCubesParams = [
        self::Dry => [
            self::DescriptionField => self::Dry,
            self::CostField => 10,
        ],
        self::Water => [
            self::DescriptionField => self::Water,
            self::CostField => 5,
        ]
    ];

    private int $quantity;

    public function __construct(BeverageInterface $beverage, int $quantity, IceCubeType $type = IceCubeType::Water)
    {
        $description = self::IceCubesParams[$type->name][self::DescriptionField];
        $cost = self::IceCubesParams[$type->name][self::CostField];
        parent::__construct($description, $cost);
        $this->beverage = $beverage;
        $this->quantity = $quantity;
    }

    protected function GetCondimentDescription(): string
    {
        return parent::GetCondimentDescription() . " ice cubes x " . $this->quantity;
    }

    protected function GetCondimentCost(): float
    {
        return parent::GetCondimentCost() * $this->quantity;
    }
}