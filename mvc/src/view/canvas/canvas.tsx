import styles from "./canvas.module.css"
import {EditorViewData} from "../../model/editor/editor";
import {Items} from "./shapes/items";
import {ControllerFunctions} from "../common/controllerFunctions";
import {Selected} from "./selected/selected";
import {DefaultValues} from "../../defaultValues";

interface CanvasViewProps {
    data: EditorViewData
    controller: ControllerFunctions
}

function Canvas(props: CanvasViewProps) {
    return <svg className={styles.canvas} width={DefaultValues.canvasWidth} height={DefaultValues.canvasHeight}>
        <Items items={props.data.shapes} controller={props.controller}/>
        {props.data.selectedShape !== null ? <Selected selectedShape={props.data.selectedShape} /> : null}
    </svg>
}

export type {CanvasViewProps}
export {Canvas}
