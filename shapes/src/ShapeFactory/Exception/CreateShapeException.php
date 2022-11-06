<?php
declare(strict_types=1);

namespace App\ShapeFactory\Exception;

use Exception;

class CreateShapeException extends Exception
{
    public function __construct(string $command, Exception $exception)
    {
        parent::__construct(
            "Error while creating form from \"{$command}\" command." . "Cause: " . $exception->getMessage()
            ,
            0,
            $exception
        );
    }
}