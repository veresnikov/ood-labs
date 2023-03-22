import {Shape} from "../../../../model/shape/shape";
import {ControllerFunctions} from "../../../controller/controllerFunctions";
import React, {useRef} from "react";
import {Point} from "../../../../common/point/point";
import {useDraw} from "../../../hooks/useDraw";
import {DefaultValues} from "../../../../defaultValues";
import {Polyline} from "../../../../model/shape/polyline";
import {ShapeFrame} from "../wrapper/wrapper";

interface DrawableProps {
    selectedShape: Shape
    controllerFunc: ControllerFunctions
    points: Point[]
    setPoints: (points: Point[]) => void
    start: React.MutableRefObject<Point>
    setFrame: (frame: ShapeFrame) => void
}

function Drawable(props: DrawableProps) {
    const onMove = (point: Point) => {
        props.points.push(point)
        props.setPoints([...props.points])
    }

    const onEnd = (points: Point[]) => {
        (props.selectedShape as Polyline).AddPoints(points)
        props.setPoints([])
        props.setFrame({
            ...props.selectedShape.GetFrame(),
            id: props.selectedShape.GetID()
        })
        props.controllerFunc.SelectShape(null)
    }

    const onStart = () => {
        props.setFrame({
            ...props.selectedShape.GetFrame(),
            id: props.selectedShape.GetID()
        })
    }

    const drawableRef = useRef(null)
    useDraw(
        drawableRef,
        props.start,
        props.points,
        onStart,
        onMove,
        onEnd
    )
    return (
        <rect
            ref={drawableRef}
            x={0}
            y={0}
            width={DefaultValues.canvasWidth}
            height={DefaultValues.canvasHeight}
            fill={"white"}
            fillOpacity={0}
        />
    )
}

export {Drawable}