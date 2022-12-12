<?php
declare(strict_types=1);

namespace App\Task;

use App\Application\ModernGraphicsLibClassAdapter;
use App\GraphicsLib\Canvas;
use App\ShapeDrawingLib\CanvasPainter;
use App\ShapeDrawingLib\Point;
use App\ShapeDrawingLib\Rectangle;
use App\ShapeDrawingLib\Triangle;

class ClassAdapterTask implements TaskInterface
{

    public function Execute(int $argc, array $argv): void
    {
        echo "Should we use new API (y)?";
        $useNewApi = fgetc(STDIN);
        if (($useNewApi == 'y' || $useNewApi == 'Y')) {
            $this->PaintPictureOnModernGraphicsRenderer();
        } else {
            $this->PaintPictureOnCanvas();
        }
    }

    private function PaintPicture(CanvasPainter $painter): void
    {
        $triangle = new Triangle(new Point(10, 15), new Point(100, 200), new Point(150, 250));
        $rectangle = new Rectangle(new Point(30, 40), 18, 24);

        $painter->Draw($triangle);
        $painter->Draw($rectangle);
    }

    private function PaintPictureOnCanvas(): void
    {
        $canvas = new Canvas();
        $canvasPainter = new CanvasPainter($canvas);
        $canvas->SetColor(0xFFF111);
        $this->PaintPicture($canvasPainter);
    }

    private function PaintPictureOnModernGraphicsRenderer(): void
    {
        $adapter = new ModernGraphicsLibClassAdapter(STDOUT);
        $canvasPainter = new CanvasPainter($adapter);
        $adapter->BeginDraw();
        $adapter->SetColor(0xFFF111);
        $this->PaintPicture($canvasPainter);
        $adapter->EndDraw();
    }
}