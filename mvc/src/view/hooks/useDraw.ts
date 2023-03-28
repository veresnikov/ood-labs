import React from "react";
import {Point} from "../../common/point/point";
import {UseBaseDragAndDrop} from "./base/useBaseDragAndDrop";
import {Normalize} from "../../common/utils/normalize";
import {DefaultValues} from "../../defaultValues";

export function useDraw(
    ref: React.RefObject<Element>,
    startPosition: React.MutableRefObject<Point>,
    buffer: Point[],
    startCallback: () => void,
    moveCallback: (point: Point) => void,
    persistCallback: (points: Point[]) => void
) {
    const onStart = (start: Point) => {
        startCallback()
        startPosition.current = {...start}
    }

    const onMove = (delta: Point) => {
        let clientRect = ref.current?.getBoundingClientRect()
        if (clientRect) {
            delta.x = Normalize(startPosition.current.x + delta.x - clientRect.x, 0, DefaultValues.canvasWidth)
            delta.y = Normalize(startPosition.current.y + delta.y - clientRect.y, 0, DefaultValues.canvasHeight)
        }
        moveCallback(delta)
    }

    const onEnd = (_: Point) => {
        persistCallback([...buffer])
    }

    UseBaseDragAndDrop(ref, onMove, onEnd, onStart)
}