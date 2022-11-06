<?php
declare(strict_types=1);

namespace App\Designer;

use App\PictureDraft\PictureDraft;

interface DesignerInterface
{

    /**
     * @param resource $input
     * @return PictureDraft
     */
    public function CreateDraft($input): PictureDraft;
}