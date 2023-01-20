<?php
declare(strict_types=1);

namespace App\ShapeGroup;

use App\Styles\OutlineStyleInterface;
use Closure;

class GroupOutlineStyle extends GroupStyle implements OutlineStyleInterface
{
    /**
     * @param Closure $callback
     */
    public function __construct(
        private Closure $callback
    )
    {
        parent::__construct($this->callback);
    }

    public function GetThickness(): ?float
    {
        $thickness = null;
        foreach ($this->GetStyles() as $style) {
            $current = $style->GetThickness();
            if (!$current) {
                return null;
            }
            if (!$thickness) {
                $thickness = $current;
                continue;
            }
            if ($thickness !== $current) {
                return null;
            }
        }
        return $thickness;
    }

    public function SetThickness(float $thickness): void
    {
        foreach ($this->GetStyles() as $style) {
            $style->SetThickness($thickness);
        }
    }

    /**
     * @return OutlineStyleInterface[]
     */
    private function GetStyles(): array
    {
        return call_user_func($this->callback);
    }
}