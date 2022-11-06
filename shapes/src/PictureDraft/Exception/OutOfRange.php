<?php

namespace App\PictureDraft\Exception;

use Exception;

class OutOfRange extends Exception
{
    public function __construct()
    {
        parent::__construct("Picture draft out of range");
    }
}