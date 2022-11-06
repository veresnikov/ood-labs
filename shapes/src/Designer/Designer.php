<?php
declare(strict_types=1);

namespace App\Designer;

use App\PictureDraft\PictureDraft;
use App\ShapeFactory\ShapeFactoryInterface;

class Designer implements DesignerInterface
{
    private ShapeFactoryInterface $shapeFactory;

    public function __construct(ShapeFactoryInterface $shapeFactory)
    {
        $this->shapeFactory = $shapeFactory;
    }

    /**
     * @param resource $input
     * @return PictureDraft
     */
    public function CreateDraft($input): PictureDraft
    {
        $draft = new PictureDraft();
        while ($command = fgets($input)) {
            try {
                $draft->AddShape($this->shapeFactory->CreateShape($command));
            } catch (\Exception $exception) {
                echo $exception->getMessage() . PHP_EOL;
            }
        }
        return $draft;
    }
}