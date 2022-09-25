<?php
declare(strict_types=1);

class BeverageVariable extends BaseBeverage
{
    public const DescriptionField = "Description";
    public const CostField = "Cost";

    protected array $rules;
    protected string $type;

    public function GetDescription(): string
    {
        return $this->rules[$this->type][self::DescriptionField] . " " . parent::GetDescription();
    }

    public function GetCost(): float
    {
        return $this->rules[$this->type][self::CostField];
    }
}