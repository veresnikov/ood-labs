<?php
declare(strict_types=1);

namespace App\ModernGraphicsLib;

class ModernGraphicsRenderer
{
    private bool $drawing = false;

    public function __construct(
        private $strm,
    )
    {
    }

    public function __destruct()
    {
        if ($this->drawing) {
            $this->EndDraw();
        }
    }

    public function BeginDraw(): void
    {
        if ($this->drawing) {
            throw new \LogicException("Drawing has already begun");
        }
        fwrite($this->strm, "<draw>" . PHP_EOL);
        $this->drawing = true;
    }

    public function DrawLine(Point $start, Point $end): void
    {
        if (!$this->drawing) {
            throw new \LogicException("DrawLine is allowed between BeginDraw()/EndDraw() only");
        }
        $x1 = $start->x;
        $y1 = $start->y;
        $x2 = $end->x;
        $y2 = $end->y;
        fwrite($this->strm, "  <line fromX=\"$x1\" fromY=\"$y1\" toX=\"$x2\" toY=\"$y2\>" . PHP_EOL);
    }

    public function EndDraw(): void
    {
        if ($this->drawing) {
            throw new \LogicException("Drawing has not been started");
        }
        fwrite($this->strm, "</draw>" . PHP_EOL);
        $this->drawing = false;
    }
}