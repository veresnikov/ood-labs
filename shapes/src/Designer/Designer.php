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
        $running = true;
        while ($command = fgets($input)) {
            $processed = false;
            $command = trim(preg_replace('/\s\s+/', ' ', $command));
            switch ($command) {
                case "exit":
                    $running = false;
                    $processed = true;
                    break;
                case "help":
                    $this->Help();
                    $processed = true;
                    break;
            }
            if (!$running) {
                break;
            }
            if ($processed) {
                continue;
            }
            try {
                $draft->AddShape($this->shapeFactory->CreateShape($command));
                $processed = true;
            } catch (\Exception $exception) {
                echo $exception->getMessage() . PHP_EOL;
            }
        }
        return $draft;
    }

    private function Help(): void
    {
        echo "ellipse color {x,y} widthRadius heightRadius" . PHP_EOL .
            "rectangle color {x,y} width height" . PHP_EOL .
            "regular_polygon color {x,y} pointsCount radius" . PHP_EOL .
            "triangle color {x,y} {x,y} {x,y}" . PHP_EOL .
            "exit" . PHP_EOL;
    }
}