import {useRef} from "react";
import {Point} from "../../../../common/point/point";
import {Color} from "../../../../common/color/color";

interface TriangleProps {
    id: string
    vertex1: Point
    vertex2: Point
    vertex3: Point
    fillColor: Color
    outlineColor: Color
    outlineThickness: number
    selectFunc: () => void
}

function Triangle(data: TriangleProps) {
    const ref = useRef(null)
    return (
        <polygon
            ref={ref}
            id={data.id}
            points={
                `${data.vertex1.x} ${data.vertex1.y},
                ${data.vertex2.x} ${data.vertex2.y},
                ${data.vertex3.x} ${data.vertex3.y}`
            }
            fill={data.fillColor}
            stroke={data.outlineColor}
            strokeWidth={data.outlineThickness}
            onClick={data.selectFunc}
        />
    )
}

export {Triangle}
