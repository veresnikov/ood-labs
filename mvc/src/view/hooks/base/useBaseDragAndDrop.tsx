import React, {useCallback, useEffect, useRef} from "react";
import {Point} from "../../../common/point/point";

type PositionHandler = (position: Point) => void
export function UseBaseDragAndDrop(
    ref: React.RefObject<Element>,
    onMouseMoveCallback?: PositionHandler,
    onMouseUpCallback?: PositionHandler,
    onMouseDownCallback?: PositionHandler,
) {
    const pagePosition = useRef<Point>({x: 0, y: 0})
    let currentPosition = useRef<Point>({x: 0, y: 0})
    const handleMouseMove = useCallback((e: MouseEvent) => {
        currentPosition.current = {
            x: e.pageX - pagePosition.current.x,
            y: e.pageY - pagePosition.current.y,
        }
        onMouseMoveCallback?.(currentPosition.current)
    }, [onMouseMoveCallback])

    const handleMouseUp = useCallback((_: MouseEvent) => {
        onMouseUpCallback?.(currentPosition.current)

        document.removeEventListener('mousemove', handleMouseMove)
        document.removeEventListener('mouseup', handleMouseUp)

    }, [handleMouseMove, onMouseUpCallback])

    const handleMouseDown = useCallback((e: Event) => {
        pagePosition.current = {
            x: (e as MouseEvent).pageX,
            y: (e as MouseEvent).pageY
        }
        onMouseDownCallback?.(pagePosition.current)

        document.addEventListener('mousemove', handleMouseMove)
        document.addEventListener('mouseup', handleMouseUp)
    }, [handleMouseMove, handleMouseUp, onMouseDownCallback])

    useEffect(() => {
        if (!ref.current) {
            return
        }
        const item = ref.current
        item.addEventListener('mousedown', handleMouseDown)

        return () => item.removeEventListener("mousedown", handleMouseDown)
    }, [ref, handleMouseDown])
}
