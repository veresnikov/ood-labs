<?php
declare(strict_types=1);

namespace App\Image;

class ImageNotExistException extends \Exception
{
    public function __construct()
    {
        parent::__construct("Image does not exit");
    }
}