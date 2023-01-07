import {Shape} from "./shape";
import {Point} from "../../common/point/point";
import {Color} from "../../common/color/color";
import {Frame} from "../frame/frame";
import {ShapeType} from "./shapeType";

class Rectangle extends Shape {
    private topLeft: Point
    private height: number
    private width: number

    constructor(id: string, topLeft: Point, height: number, width: number, fillColor: Color | null = null, outlineColor: Color | null = null, outlineThickness: number | null = null) {
        super(id, fillColor, outlineColor, outlineThickness);
        this.topLeft = topLeft
        this.height = height
        this.width = width
    }

    GetTopLeft(): Point {
        return this.topLeft
    }

    GetHeight(): number {
        return this.height
    }

    GetWight(): number {
        return this.width
    }

    GetFrame(): Frame {
        return new Frame(
            this.topLeft,
            this.width,
            this.height,
        )
    }

    SetFrame(frame: Frame): void {
        this.width = frame.GetWidth()
        this.height = frame.GetHeight()
        this.topLeft = frame.GetTopLeft()
    }

    GetType(): ShapeType {
        return ShapeType.Rectangle
    }
}

export {Rectangle}
