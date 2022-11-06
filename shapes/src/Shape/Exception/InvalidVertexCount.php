<?php
declare(strict_types=1);

namespace App\Shape\Exception;

use Exception;

class InvalidVertexCount extends Exception
{
    public function __construct()
    {
        parent::__construct("Invalid vertex count");
    }
}