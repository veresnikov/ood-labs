import React from "react";
import {Point} from "../../common/point/point";
import {UseBaseDragAndDrop} from "./base/useBaseDragAndDrop";

export function useMoving(
    ref: React.RefObject<Element>,
    position: Point | null,
    moveCallback: (point: Point) => void,
    persistCallback: (point: Point) => void
) {
    const onStart = (position: Point) => {}

    const onMove = (delta: Point) => {
        if (!position) {
            return
        }
        if (ref.current?.getBoundingClientRect()) {
            delta.x = position.x + delta.x
            delta.y = position.y + delta.y
        }
        moveCallback(delta)
    }

    const onEnd = (position: Point) => {
        persistCallback(position)
    }

    UseBaseDragAndDrop(ref, onMove, onEnd, onStart)
}