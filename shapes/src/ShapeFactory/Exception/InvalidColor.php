<?php
declare(strict_types=1);

namespace App\ShapeFactory\Exception;

use Exception;

class InvalidColor extends Exception
{
    public function __construct()
    {
        parent::__construct("Invalid color");
    }
}