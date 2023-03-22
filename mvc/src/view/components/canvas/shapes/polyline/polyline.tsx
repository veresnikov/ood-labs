import {useEffect, useRef, useState} from "react";
import {ShapeFrameProps, ShapeDrawableProps} from "../../wrapper/wrapper";
import {Polyline as PolylineModel} from "../../../../../model/shape/polyline";
import {TransformPoint} from "../../../../../common/transform/transform";
import {Point} from "../../../../../common/point/point";

interface PolylineProps extends ShapeFrameProps, ShapeDrawableProps {
    id: string
    polyline: PolylineModel
    selectFunc: () => void
}

const getPolylineData = (data: PolylineProps) => {
    let points = data.polyline.GetPoints()
    if (data.id === data.frame.id && data.points.length !== 0) {
        points = data.points
    }

    let strPoints: string[]

    const current = data.polyline.GetFrame()
    if (current.height !== 0 && current.width !== 0) {
        let transformX = data.frame.width / current.width
        let transformY = data.frame.height / current.height
        strPoints = points.map(p => {
            const point = TransformPoint(p, current, data.frame, transformX, transformY)
            return `${point.x},${point.y}`
        })
    } else {
        strPoints = points.map(p => {
            return `${p.x},${p.y}`
        })
    }

    return {
        points: strPoints.join(" ")
    }
}

function Polyline(data: PolylineProps) {
    const ref = useRef(null)
    let points = data.polyline.GetPoints()
    if (data.id === data.frame.id && data.points.length !== 0) {
        points = data.points
    }
    const [polylineData, setPolylineData] = useState({
        points: ""
    })
    useEffect(() => {
        if (data.id === data.frame.id) {
            data.setFrame({
                id: data.id,
                ...data.polyline.GetFrame()
            })
            setPolylineData({...getPolylineData(data)})
        }
    }, [points, data.points])

    const selectFunc = () => {
        data.setFrame({id: data.id, ...data.polyline.GetFrame()})
        data.selectFunc()
    }
    return (
        <polyline
            ref={ref}
            id={data.id}
            {...polylineData}
            fill="none"
            stroke={data.polyline.GetOutlineColor()}
            strokeWidth={data.polyline.GetOutlineThickness()}
            onClick={selectFunc}
        />
    )
}

export {Polyline}
