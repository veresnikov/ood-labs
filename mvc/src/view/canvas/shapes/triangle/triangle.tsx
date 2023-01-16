import {useEffect, useRef} from "react";
import {Triangle as TriangleModel} from "../../../../model/shape/triangle";
import {ShapeFrameProps} from "../../wrapper/wrapper";

interface TriangleProps extends ShapeFrameProps {
    id: string
    triangle: TriangleModel
    selectFunc: () => void
}

const getTriangleData = (data: TriangleProps) => {
    if (data.id !== data.frame.id) {
        return {
            points: `${data.triangle.GetVertex1().x} ${data.triangle.GetVertex1().y},
            ${data.triangle.GetVertex2().x} ${data.triangle.GetVertex2().y},
            ${data.triangle.GetVertex3().x} ${data.triangle.GetVertex3().y}`
        }
    } else {
        const current = data.triangle.GetFrame()
        let transformX = data.frame.width / current.width
        let transformY = data.frame.height / current.height
        const vertex1 = TriangleModel.TransformPoint(data.triangle.GetVertex1(), current, data.frame, transformX, transformY)
        const vertex2 = TriangleModel.TransformPoint(data.triangle.GetVertex2(), current, data.frame, transformX, transformY)
        const vertex3 = TriangleModel.TransformPoint(data.triangle.GetVertex3(), current, data.frame, transformX, transformY)
        return {
            points: `${vertex1.x} ${vertex1.y},
            ${vertex2.x} ${vertex2.y},
            ${vertex3.x} ${vertex3.y}`
        }
    }
}

function Triangle(data: TriangleProps) {
    const ref = useRef(null)
    const topLeft = data.triangle.GetFrame().topLeft
    const vertex1 = data.triangle.GetVertex1()
    const vertex2 = data.triangle.GetVertex2()
    const vertex3 = data.triangle.GetVertex3()

    useEffect(() => {
        if (data.id === data.frame.id) {
            data.setFrame({
                id: data.id,
                ...data.triangle.GetFrame()
            })
        }
    }, [topLeft.x, topLeft.y, vertex1.x, vertex1.y, vertex2.x, vertex2.y, vertex3.x, vertex3.y])

    const selectFunc = () => {
        data.setFrame({id: data.id, ...data.triangle.GetFrame()})
        data.selectFunc()
    }

    const triangleData = getTriangleData(data)

    return (
        <polygon
            ref={ref}
            id={data.id}
            {...triangleData}
            fill={data.triangle.GetFillColor()}
            stroke={data.triangle.GetOutlineColor()}
            strokeWidth={data.triangle.GetOutlineThickness()}
            onClick={selectFunc}
        />
    )
}

export {Triangle}
