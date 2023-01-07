import {Point} from "../../common/point/point";

class Frame {
    private topLeft: Point
    private width: number
    private height: number

    constructor(topLeft: Point, width: number, height: number) {
        this.topLeft = topLeft
        this.width = width
        this.height = height
    }

    GetTopLeft(): Point {
        return this.topLeft
    }

    GetWidth(): number {
        return this.width
    }

    GetHeight(): number {
        return this.height
    }

    SetTopLeft(topLeft: Point): void {
        this.topLeft = topLeft
    }

    SetWidth(width: number): void {
        this.width = width
    }

    SetHeight(height: number): void {
        this.height = height
    }
}

export {Frame}