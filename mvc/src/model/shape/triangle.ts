import {Shape} from "./shape";
import {Frame} from "../frame/frame";
import {Point} from "../../common/point/point";
import {Color} from "../../common/color/color";
import {ShapeType} from "./shapeType";


class Triangle extends Shape {
    private vertex1: Point
    private vertex2: Point
    private vertex3: Point

    constructor(
        id: string,
        vertex1: Point,
        vertex2: Point,
        vertex3: Point,
        fillColor: Color | null = null,
        outlineColor: Color | null = null,
        outlineThickness: number | null = null
    ) {
        super(id, fillColor, outlineColor, outlineThickness);
        this.vertex1 = vertex1
        this.vertex2 = vertex2
        this.vertex3 = vertex3
    }

    GetVertex1(): Point {
        return this.vertex1
    }

    GetVertex2(): Point {
        return this.vertex2
    }

    GetVertex3(): Point {
        return this.vertex3
    }

    GetFrame(): Frame {
        let minX = Math.min(this.vertex1.x, this.vertex2.x, this.vertex3.x)
        let minY = Math.min(this.vertex1.y, this.vertex2.y, this.vertex3.y)
        let maxX = Math.max(this.vertex1.x, this.vertex2.x, this.vertex3.x)
        let maxY = Math.max(this.vertex1.y, this.vertex2.y, this.vertex3.y)
        return {
            topLeft: {
                x: minX,
                y: minY
            },
            width: maxX - minX,
            height: maxY - minY,
        }
    }

    SetFrame(frame: Frame): void {
        const current = this.GetFrame()
        let transformX = frame.width / current.width
        let transformY = frame.height / current.height
        this.vertex1 = Triangle.TransformPoint(this.vertex1, current, frame, transformX, transformY)
        this.vertex2 = Triangle.TransformPoint(this.vertex2, current, frame, transformX, transformY)
        this.vertex3 = Triangle.TransformPoint(this.vertex3, current, frame, transformX, transformY)
    }

    GetType(): ShapeType {
        return ShapeType.Triangle
    }

    static TransformPoint(point: Point, current: Frame, next: Frame, transformX: number, transformY: number): Point {
        return  {
            x: next.topLeft.x + (point.x - current.topLeft.x) * transformX,
            y: next.topLeft.y + (point.y - current.topLeft.y) * transformY,
        }
    }
}

export {Triangle}
