import styles from "./canvas.module.css"
import {EditorViewData} from "../../model/editor/editor";
import {Items} from "./shapes/items";
import {ControllerFunctions} from "../controller/controllerFunctions";
import {Selected} from "./selected/selected";
import {DefaultValues} from "../../defaultValues";
import {useState} from "react";
import {Frame} from "../../model/frame/frame";

interface CanvasViewProps {
    data: EditorViewData
    controller: ControllerFunctions
}

interface FrameWithId {
    id: string
    frame: Frame
}

function Canvas(props: CanvasViewProps) {
    const [frame, setFrame] = useState<FrameWithId | null>(null)

    return <svg className={styles.canvas} width={DefaultValues.canvasWidth} height={DefaultValues.canvasHeight}>
        <Items items={props.data.shapes} controller={props.controller} setFrame={setFrame} frame={frame}/>
        {props.data.selectedShape !== null ?
            <Selected selectedShape={props.data.selectedShape} setFrame={setFrame} frame={frame}
                      controllerFunc={props.controller}/> : null}
    </svg>
}

export type {CanvasViewProps, FrameWithId}
export {Canvas}
