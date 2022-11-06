<?php
declare(strict_types=1);

namespace App\ShapeFactory;

use App\Color\Color;
use App\Point\Point;
use App\Shape\Ellipse;
use App\Shape\Exception\InvalidVertexCount;
use App\ShapeFactory\Exception\CreateShapeException;
use App\ShapeFactory\Exception\InvalidColor;
use App\ShapeFactory\Exception\InvalidPoint;
use App\ShapeFactory\Exception\InvalidShapeType;
use App\Shape\Rectangle;
use App\Shape\RegularPolygon;
use App\Shape\Shape;
use App\Shape\Triangle;
use App\ShapeFactory\Exception\IncorrectNumberOfParameters;

class ShapeFactory implements ShapeFactoryInterface
{
    /**
     * @throws IncorrectNumberOfParameters
     * @throws CreateShapeException
     */
    public function CreateShape(string $input): Shape
    {
        $params = explode(" ", $input);
        if (count($params) < 1) {
            throw new IncorrectNumberOfParameters();
        }
        $shapeType = $params[0];
        array_shift($params);
        try {
            $shape = match ($shapeType) {
                "ellipse" => $this->CreateEllipse($params),
                "rectangle" => $this->CreatRectangle($params),
                "regular_polygon" => $this->CreateRegularPolygon($params),
                "triangle" => $this->CreateTriangle($params),
                default => throw new InvalidShapeType(),
            };
        } catch (\Exception $exception) {
            throw new CreateShapeException($input, $exception);
        }
        return $shape;
    }

    /**
     * @throws IncorrectNumberOfParameters
     * @throws InvalidColor
     * @throws InvalidPoint
     */
    private function CreateEllipse(array $params): Ellipse
    {
        if (count($params) != 4) {
            throw new IncorrectNumberOfParameters();
        }
        $color = $this->GetColor($params[0]);
        $center = $this->GetPoint($params[1]);
        $widthRadius = intval($params[2]);
        $heightRadius = intval($params[3]);
        return new Ellipse($color, $center, $widthRadius, $heightRadius);
    }

    /**
     * @throws IncorrectNumberOfParameters
     * @throws InvalidColor
     * @throws InvalidPoint
     */
    private function CreatRectangle(array $params): Rectangle
    {
        if (count($params) != 4) {
            throw new IncorrectNumberOfParameters();
        }
        $color = $this->GetColor($params[0]);
        $center = $this->GetPoint($params[1]);
        $width = intval($params[2]);
        $height = intval($params[3]);
        return new Rectangle($color, $center, $width, $height);
    }

    /**
     * @throws IncorrectNumberOfParameters
     * @throws InvalidColor
     * @throws InvalidVertexCount
     * @throws InvalidPoint
     */
    private function CreateRegularPolygon(array $params): RegularPolygon
    {
        if (count($params) != 4) {
            throw new IncorrectNumberOfParameters();
        }
        $color = $this->GetColor($params[0]);
        $center = $this->GetPoint($params[1]);
        $pointsCount = intval($params[2]);
        $radius = intval($params[3]);
        return new RegularPolygon($color, $center, $pointsCount, $radius);
    }

    /**
     * @throws IncorrectNumberOfParameters
     * @throws InvalidColor
     * @throws InvalidPoint
     */
    private function CreateTriangle(array $params): Triangle
    {
        if (count($params) != 4) {
            throw new IncorrectNumberOfParameters();
        }
        $color = $this->GetColor($params[0]);
        $first = $this->GetPoint($params[1]);
        $second = $this->GetPoint($params[2]);
        $three = $this->GetPoint($params[3]);
        return new Triangle($color, $first, $second, $three);
    }

    private function GetPoint(string $point): Point
    {
        if (!$this->IsValidPoint($point)) {
            throw new InvalidPoint();
        }
        preg_match_all("/\d+(?:[.]\d+)?/", $point, $matches);
        return new Point(floatval($matches[0][0]), floatval($matches[0][1]));
    }

    private function IsValidPoint(string $point): bool
    {
        return preg_match("{\d+(?:[.]\d+)?,\d+(?:[.]\d+)?}", $point) === 1;
    }

    /**
     * @throws InvalidColor
     */
    private function GetColor(string $color): Color
    {
        return match ($color) {
            "red" => Color::Red,
            "green" => Color::Green,
            "blue" => Color::Blue,
            "pink" => Color::Pink,
            "yellow" => Color::Yellow,
            "black" => Color::Black,
            default => throw new InvalidColor(),
        };
    }
}