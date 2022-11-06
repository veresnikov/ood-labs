<?php
declare(strict_types=1);

namespace App\Painter;

use App\Canvas\CanvasInterface;
use App\PictureDraft\PictureDraft;

class Painter
{
    public static function DrawPicture(PictureDraft $draft, CanvasInterface $canvas):void
    {
        for ($index = 0; $index <= $draft->GetShapesCount(); $index++) {
            $shape = $draft->GetShape($index);
            $shape->Draw($canvas);
        }
    }
}