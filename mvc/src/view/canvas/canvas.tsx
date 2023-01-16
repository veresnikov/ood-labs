import styles from "./canvas.module.css"
import {EditorViewData} from "../../model/editor/editor";
import {ControllerFunctions} from "../controller/controllerFunctions";
import {DefaultValues} from "../../defaultValues";
import {Wrapper} from "./wrapper/wrapper";

interface CanvasViewProps {
    data: EditorViewData
    controller: ControllerFunctions
}
function Canvas(props: CanvasViewProps) {
    return <svg className={styles.canvas} width={DefaultValues.canvasWidth} height={DefaultValues.canvasHeight}>
        <Wrapper {...props} />
    </svg>
}

export type {CanvasViewProps}
export {Canvas}
