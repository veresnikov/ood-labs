import styles from "./selected.module.css"
import {useRef} from "react";
import {Shape} from "../../../../model/shape/shape";
import {useMoving} from "../../../hooks/useMoving";
import {Point} from "../../../../common/point/point";
import {ControllerFunctions} from "../../../controller/controllerFunctions";
import {ShapeFrameProps} from "../wrapper/wrapper";
import {useResize} from "../../../hooks/useResize";
import {useOutsideClick} from "../../../hooks/useOutsideClick";

interface SelectedProps extends ShapeFrameProps {
    selectedShape: Shape
    controllerFunc: ControllerFunctions
}

function Selected(props: SelectedProps) {
    const selectorRef = useRef(null)
    const setPosition = (position: Point) => {
        props.setFrame({
            ...props.frame,
            topLeft: position
        })
    }

    useMoving(selectorRef, props.frame.topLeft, setPosition, (point: Point) => {
        props.controllerFunc.MoveShape(point)
    })

    const resizeRef = useRef(null)
    const setSize = (width: number, height: number) => {
        props.setFrame({
            ...props.frame,
            width: width,
            height: height
        })
    }

    useResize(resizeRef, props.frame, setSize, (width, height) => {
        props.controllerFunc.ResizeShape(width, height)
    })

    const selectedContainerRef = useRef(null)

    useOutsideClick(selectedContainerRef, () => {
        props.controllerFunc.SelectShape(null)
    })

    return (
        <g ref={selectedContainerRef}>
            <rect
                className={styles.selected}
                ref={selectorRef}
                x={props.frame.topLeft.x}
                y={props.frame.topLeft.y}
                width={props.frame.width}
                height={props.frame.height}
            />
            <circle
                ref={resizeRef}
                cx={props.frame.topLeft.x + props.frame.width}
                cy={props.frame.topLeft.y + props.frame.height}
                r={5}
            />
        </g>
    )
}

export type {SelectedProps}
export {Selected}
