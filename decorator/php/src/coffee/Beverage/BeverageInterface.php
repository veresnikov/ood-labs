<?php
declare(strict_types=1);

interface BeverageInterface
{
    public function GetDescription(): string;
    public function GetCost(): float;
}