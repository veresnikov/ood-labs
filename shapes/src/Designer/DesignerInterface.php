<?php
declare(strict_types=1);

namespace App\Designer;

use App\PictureDraft\PictureDraft;

interface DesignerInterface
{
    public function CreateDraft(array $input): PictureDraft;
}