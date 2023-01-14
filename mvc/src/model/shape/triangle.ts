import {Shape} from "./shape";
import {Frame} from "../frame/frame";
import {Point} from "../../common/point/point";
import {Color} from "../../common/color/color";
import {ShapeType} from "./shapeType";


class Triangle extends Shape {
    private vertex1: Point
    private vertex2: Point
    private vertex3: Point

    constructor(id: string, vertex1: Point, vertex2: Point, vertex3: Point, fillColor: Color | null = null, outlineColor: Color | null = null, outlineThickness: number | null = null) {
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
        return new Frame(
            {
                x: minX,
                y: minY,
            },
            maxX - minX,
            maxY - minY,
        )
    }

    SetFrame(frame: Frame): void {
        let current = this.GetFrame()
        let transformX = frame.GetWidth() / current.GetWidth()
        let transformY = frame.GetHeight() / current.GetHeight()
        this.TransformPoint(this.vertex1, current, frame, transformX, transformY)
        this.TransformPoint(this.vertex2, current, frame, transformX, transformY)
        this.TransformPoint(this.vertex3, current, frame, transformX, transformY)
    }

    GetType(): ShapeType {
        return ShapeType.Triangle
    }

    private TransformPoint(point: &Point, current: Frame, next: Frame, transformX: number, transformY: number): void {
        point = {
            x: next.GetTopLeft().x + (point.x - current.GetTopLeft().x) * transformX,
            y: next.GetTopLeft().y + (point.y - current.GetTopLeft().y) * transformY,
        }
    }
}

export {Triangle}
