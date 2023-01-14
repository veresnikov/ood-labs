import styles from "./selected.module.css"
import {useRef} from "react";
import {Shape} from "../../../model/shape/shape";

interface SelectedProps {
    selectedShape: Shape
}
function Selected(props: SelectedProps) {
    const ref = useRef(null)
    const frame = props.selectedShape.GetFrame()
    const topLeft = frame.GetTopLeft()
    console.log(props.selectedShape)
    console.log(frame)
    return (
        <rect
            className={styles.selected}
            ref={ref}
            x={topLeft.x}
            y={topLeft.y}
            width={frame.GetWidth()}
            height={frame.GetHeight()}
        />
    )
}

export type {SelectedProps}
export {Selected}
