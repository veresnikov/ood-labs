<?php
declare(strict_types=1);

abstract class BaseBeverage implements BeverageInterface
{
    public function __construct(
        private string $description,
    )
    {
    }

    public function GetDescription(): string
    {
        return $this->description;
    }
}