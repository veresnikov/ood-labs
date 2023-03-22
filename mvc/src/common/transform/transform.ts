import {Point} from "../point/point";
import {Frame} from "../../model/frame/frame";

function TransformPoint(point: Point, current: Frame, next: Frame, transformX: number, transformY: number): Point {
    return {
        x: next.topLeft.x + (point.x - current.topLeft.x) * transformX,
        y: next.topLeft.y + (point.y - current.topLeft.y) * transformY,
    }
}

export {TransformPoint}