import styles from "./selected.module.css"
import {useEffect, useRef} from "react";
import {Shape} from "../../../model/shape/shape";
import {useMoving} from "../../hooks/useMoving";
import {Frame} from "../../../model/frame/frame";
import {Point} from "../../../common/point/point";
import {ControllerFunctions} from "../../controller/controllerFunctions";
import {FrameWithId} from "../canvas";

interface SelectedProps {
    selectedShape: Shape
    frame: FrameWithId | null
    setFrame: (frame: FrameWithId | null) => void
    controllerFunc: ControllerFunctions
}

function Selected(props: SelectedProps) {
    const ref = useRef(null)
    const setPosition = (position: Point) => {
        if (props.frame === null) {
            return
        }
        props.setFrame({
            id: props.selectedShape.GetID(),
            frame: new Frame(
                position,
                props.frame.frame.GetWidth(),
                props.frame.frame.GetHeight(),
            )
        })
    }

    const topLeft = props.frame?.frame.GetTopLeft() ?? null
    useMoving(ref, topLeft, setPosition, (point) => {
        if (props.frame) {
            props.controllerFunc.MoveShape(point)
        }
    })

    if (props.frame === null) {
        return null
    }
    return (
        <rect
            className={styles.selected}
            ref={ref}
            x={topLeft?.x}
            y={topLeft?.y}
            width={props.frame.frame.GetWidth()}
            height={props.frame.frame.GetHeight()}
        />
    )
}

export type {SelectedProps}
export {Selected}
