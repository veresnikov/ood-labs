import {Shape} from "./shape";
import {Point} from "../../common/point/point";
import {Color} from "../../common/color/color";
import {Frame} from "../frame/frame";
import {ShapeType} from "./shapeType";
import {TransformPoint} from "../../common/transform/transform";

class Polyline extends Shape {
    private points: Point[] = []

    constructor(
        id: string,
        outlineColor: Color | null = null,
        outlineThickness: number | null = null) {
        super(id, null, outlineColor, outlineThickness);
    }

    AddPoints(points: Point[]): void {
        this.points = [...this.points, ...points]
    }

    GetPoints(): Point[] {
        return this.points
    }

    GetFrame(): Frame {
        if (this.points.length === 0) {
            return {
                topLeft: {x: 0, y: 0},
                width: 0,
                height: 0,
            }
        }
        let topLeft = {...this.points[0]}
        let width = topLeft.x
        let height = topLeft.y
        this.points.forEach(p => {
            if (topLeft.x > p.x) {
                topLeft.x = p.x
            }
            if (topLeft.y > p.y) {
                topLeft.y = p.y
            }
            if (width < p.x) {
                width = p.x
            }
            if (height < p.y) {
                height = p.y
            }
        })
        return {
            topLeft: topLeft,
            width: width - topLeft.x,
            height: height - topLeft.y,
        }
    }

    SetFrame(frame: Frame): void {
        const current = this.GetFrame()
        let transformX = frame.width / current.width
        let transformY = frame.height / current.height
        this.points = this.points.map(p => {
            return TransformPoint(p, current, frame, transformX, transformY)
        })
    }

    GetType(): ShapeType {
        return ShapeType.Polyline
    }
}

export {Polyline}
