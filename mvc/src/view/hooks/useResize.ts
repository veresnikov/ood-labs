import {RefObject} from "react";
import {Frame} from "../../model/frame/frame";
import {Point} from "../../common/point/point";
import {UseBaseDragAndDrop} from "./base/useBaseDragAndDrop";

function useResize(
    ref: RefObject<Element>,
    frame: Frame,
    resizeCallback: (width: number, height: number) => void,
    persistCallback: (width: number, height: number) => void
) {
    const onStart = (position: Point) => {
    }

    const onMove = (delta: Point) => {
        delta.x = delta.x + frame.width
        delta.y = delta.y + frame.height
        resizeCallback(delta.x, delta.y)
    }

    const onEnd = (position: Point) => {
        persistCallback(position.x, position.y)
    }

    UseBaseDragAndDrop(ref, onMove, onEnd, onStart)
}

export {useResize}