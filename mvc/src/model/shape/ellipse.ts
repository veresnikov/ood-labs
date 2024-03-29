import {Shape} from "./shape";
import {Point} from "../../common/point/point";
import {Color} from "../../common/color/color";
import {Frame} from "../frame/frame";
import {ShapeType} from "./shapeType";

class Ellipse extends Shape {
    private center: Point
    private height: number
    private width: number

    constructor(
        id: string,
        center: Point,
        height: number,
        width: number,
        fillColor: Color | null = null,
        outlineColor: Color | null = null,
        outlineThickness: number | null = null) {
        super(id, fillColor, outlineColor, outlineThickness);
        this.center = center
        this.height = height
        this.width = width
    }

    GetCenter(): Point {
        return this.center
    }

    GetHeight(): number {
        return this.height
    }

    GetWight(): number {
        return this.width
    }

    GetFrame(): Frame {
        return {
            topLeft: {
                x: this.center.x - this.width,
                y: this.center.y - this.height
            },
            width: this.width * 2,
            height: this.height * 2
        }
    }

    SetFrame(frame: Frame): void {
        this.width = frame.width / 2
        this.height = frame.height / 2
        this.center = {
            x: frame.topLeft.x + this.width,
            y: frame.topLeft.y + this.height,
        }
    }

    GetType(): ShapeType {
        return ShapeType.Ellipse
    }
}

export {Ellipse}
