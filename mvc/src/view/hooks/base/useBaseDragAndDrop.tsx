import React, {useCallback, useEffect} from "react";
import {Point} from "../../../common/point/point";

type PositionHandler = (position: Point) => void
export function UseBaseDragAndDrop(
    ref: React.RefObject<Element>,
    onMouseMoveCallback?: PositionHandler,
    onMouseUpCallback?: PositionHandler,
    onMouseDownCallback?: PositionHandler,
) {
    let pagePosition: Point
    let currentPosition: Point
    const handleMouseMove = useCallback((e: MouseEvent) => {
        currentPosition = {
            x: e.pageX - pagePosition.x,
            y: e.pageY - pagePosition.y,
        }
        onMouseMoveCallback?.(currentPosition)
    }, [onMouseMoveCallback])

    const handleMouseUp = useCallback((e: MouseEvent) => {
        onMouseUpCallback?.(currentPosition)

        document.removeEventListener('mousemove', handleMouseMove)
        document.removeEventListener('mouseup', handleMouseUp)

    }, [handleMouseMove, onMouseUpCallback])

    const handleMouseDown = useCallback((e: Event) => {
        pagePosition = {
            x: (e as MouseEvent).pageX,
            y: (e as MouseEvent).pageY
        }
        onMouseDownCallback?.(pagePosition)

        document.addEventListener('mousemove', handleMouseMove)
        document.addEventListener('mouseup', handleMouseUp)
    }, [handleMouseMove, onMouseUpCallback, onMouseDownCallback])

    useEffect(() => {
        if (!ref.current) {
            return
        }
        const item = ref.current
        item.addEventListener('mousedown', handleMouseDown)

        return () => item.removeEventListener("mousedown", handleMouseDown)
    }, [ref, handleMouseDown])
}
