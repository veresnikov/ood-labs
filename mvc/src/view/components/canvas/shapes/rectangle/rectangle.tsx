import {useEffect, useRef} from "react";
import {Rectangle as RectangleModel} from "../../../../../model/shape/rectangle";
import {ShapeFrameProps} from "../../wrapper/wrapper";

interface RectangleProps extends ShapeFrameProps {
    id: string
    rectangle: RectangleModel
    selectFunc: () => void
}

const getRectangleData = (data: RectangleProps) => {
    if (data.id !== data.frame.id) {
        return {
            x: data.rectangle.GetTopLeft().x,
            y: data.rectangle.GetTopLeft().y,
            width: data.rectangle.GetWight(),
            height: data.rectangle.GetHeight(),
        }
    } else {
        return {
            x: data.frame.topLeft.x,
            y: data.frame.topLeft.y,
            width: data.frame.width,
            height: data.frame.height,
        }
    }
}

function Rectangle(data: RectangleProps) {
    const ref = useRef(null)
    const topLeft = data.rectangle.GetTopLeft()
    const width = data.rectangle.GetWight()
    const height = data.rectangle.GetHeight()

    useEffect(() => {
        if (data.id === data.frame.id) {
            data.setFrame({
                id: data.id,
                ...data.rectangle.GetFrame()
            })
        }
        // eslint-disable-next-line
    }, [topLeft.x, topLeft.y, width, height])

    const selectFunc = () => {
        data.setFrame({id: data.id, ...data.rectangle.GetFrame()})
        data.selectFunc()
    }

    const rectangleData = getRectangleData(data)

    return (
        <rect
            ref={ref}
            id={data.id}
            {...rectangleData}
            fill={data.rectangle.GetFillColor()}
            stroke={data.rectangle.GetOutlineColor()}
            strokeWidth={data.rectangle.GetOutlineThickness()}
            onClick={selectFunc}
        />
    )
}

export {Rectangle}
