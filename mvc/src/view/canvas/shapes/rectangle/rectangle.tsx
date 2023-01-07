import {useRef} from "react";
import {Point} from "../../../../common/point/point";
import {Color} from "../../../../common/color/color";

interface RectangleProps {
    id: string
    topLeft: Point
    height: number
    width: number
    fillColor: Color
    outlineColor: Color
    outlineThickness: number
}

function Rectangle(data: RectangleProps) {
    const ref = useRef(null)
    return (
        <rect
            ref={ref}
            id={data.id}
            x={data.topLeft.x}
            y={data.topLeft.y}
            width={data.width}
            height={data.height}
            fill={data.fillColor}
            stroke={data.outlineColor}
            strokeWidth={data.outlineThickness}
        />
    )
}

export {Rectangle}
