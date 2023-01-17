import React from "react";
import {Point} from "../../common/point/point";
import {UseBaseDragAndDrop} from "./base/useBaseDragAndDrop";
import {Normalize} from "../../common/utils/normalize";
import {DefaultValues} from "../../defaultValues";

export function useMoving(
    ref: React.RefObject<Element>,
    position: Point,
    moveCallback: (point: Point) => void,
    persistCallback: (point: Point) => void
) {
    const onStart = (_: Point) => {
    }

    const onMove = (delta: Point) => {
        let clientRect = ref.current?.getBoundingClientRect()
        if (clientRect) {
            delta.x = Normalize(position.x + delta.x, 0, DefaultValues.canvasWidth - clientRect.width)
            delta.y =  Normalize(position.y + delta.y, 0, DefaultValues.canvasHeight - clientRect.height)
        }
        moveCallback(delta)
    }

    const onEnd = (position: Point) => {
        persistCallback(position)
    }

    UseBaseDragAndDrop(ref, onMove, onEnd, onStart)
}