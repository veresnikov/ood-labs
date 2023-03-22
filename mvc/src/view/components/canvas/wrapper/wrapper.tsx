import {EditorViewData} from "../../../../model/editor/editor";
import {ControllerFunctions} from "../../../controller/controllerFunctions";
import React, {useRef, useState} from "react";
import {Frame} from "../../../../model/frame/frame";
import {Items} from "../shapes/items";
import {Selected} from "../selected/selected";
import {ShapeType} from "../../../../model/shape/shapeType";
import {Polyline} from "../../../../model/shape/polyline";
import {Drawable} from "../drawable/drawable";
import {Point} from "../../../../common/point/point";

interface WrapperProps {
    data: EditorViewData
    controller: ControllerFunctions
}

interface ShapeFrame extends Frame {
    id: string
}

interface ShapeFrameProps {
    setFrame: (frame: ShapeFrame) => void
    frame: ShapeFrame
}

interface ShapeDrawableProps {
    points: Point[]
}

function Wrapper(props: WrapperProps) {
    const [frame, setFrame] = useState<ShapeFrame>({
        id: '',
        topLeft: {x: 0, y: 0},
        width: 0,
        height: 0
    })

    const [bufferPoints, setBufferPoints] = useState<Point[]>([])
    const startPoint = useRef<Point>({x: 0, y: 0})
    const isDrawing = props.data.selectedShape?.GetType() === ShapeType.Polyline && (props.data.selectedShape as Polyline).GetPoints().length === 0

    return (
        <>
            {
                props.data.selectedShape && isDrawing ?
                    < Drawable
                        selectedShape={props.data.selectedShape}
                        controllerFunc={props.controller}
                        points={bufferPoints}
                        setPoints={setBufferPoints}
                        start={startPoint}
                        setFrame={setFrame}
                    /> : null
            }
            <Items
                items={props.data.shapes}
                controller={props.controller}
                frame={frame}
                setFrame={setFrame}
                points={bufferPoints}
            />
            {
                props.data.selectedShape ?
                    !isDrawing ?
                        < Selected
                            selectedShape={props.data.selectedShape}
                            controllerFunc={props.controller}
                            frame={frame}
                            setFrame={setFrame}
                        />
                        : null
                    : null
            }
        </>
    )
}

export type {ShapeFrame, ShapeFrameProps, ShapeDrawableProps}
export {Wrapper}
