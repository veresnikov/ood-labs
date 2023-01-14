import {useRef} from "react";
import {Point} from "../../../../common/point/point";
import {Color} from "../../../../common/color/color";

interface EllipseProps {
    id: string
    center: Point
    height: number
    width: number
    fillColor: Color
    outlineColor: Color
    outlineThickness: number
    selectFunc: () => void
}

function Ellipse(data: EllipseProps) {
    const ref = useRef(null)
    return (
        <ellipse
            ref={ref}
            id={data.id}
            cx={data.center.x}
            cy={data.center.y}
            rx={data.width}
            ry={data.height}
            fill={data.fillColor}
            stroke={data.outlineColor}
            strokeWidth={data.outlineThickness}
            onClick={data.selectFunc}
        />
    )
}

export {Ellipse}
