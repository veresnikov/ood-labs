import {useEffect, useRef} from "react";
import {Ellipse as EllipseModel} from "../../../../../model/shape/ellipse";
import {ShapeFrameProps} from "../../wrapper/wrapper";

interface EllipseProps extends ShapeFrameProps {
    id: string
    ellipse: EllipseModel
    selectFunc: () => void
}

const getEllipseData = (data: EllipseProps) => {
    if (data.id !== data.frame.id) {
        return {
            cx: data.ellipse.GetCenter().x,
            cy: data.ellipse.GetCenter().y,
            rx: data.ellipse.GetWight(),
            ry: data.ellipse.GetHeight(),
        }
    } else {
        return {
            cx: data.frame.topLeft.x + data.frame.width / 2,
            cy: data.frame.topLeft.y + data.frame.height / 2,
            rx: data.frame.width / 2,
            ry: data.frame.height / 2,
        }
    }
}

function Ellipse(data: EllipseProps) {
    const ref = useRef(null)
    const center = data.ellipse.GetCenter()
    const width = data.ellipse.GetWight()
    const height = data.ellipse.GetHeight()

    useEffect(() => {
        if (data.id === data.frame.id) {
            data.setFrame({
                id: data.id,
                ...data.ellipse.GetFrame()
            })
        }
    }, [center.x, center.y, width, height])

    const selectFunc = () => {
        data.setFrame({id: data.id, ...data.ellipse.GetFrame()})
        data.selectFunc()
    }

    const ellipseData = getEllipseData(data)

    return (
        <ellipse
            ref={ref}
            id={data.id}
            {...ellipseData}
            fill={data.ellipse.GetFillColor()}
            stroke={data.ellipse.GetOutlineColor()}
            strokeWidth={data.ellipse.GetOutlineThickness()}
            onClick={selectFunc}
        />
    )
}

export {Ellipse}
