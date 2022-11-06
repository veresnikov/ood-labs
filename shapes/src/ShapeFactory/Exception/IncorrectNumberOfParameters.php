<?php
declare(strict_types=1);

namespace App\ShapeFactory\Exception;

class IncorrectNumberOfParameters extends \Exception
{
    public function __construct()
    {
        parent::__construct("Incorrect number of parameters");
    }
}