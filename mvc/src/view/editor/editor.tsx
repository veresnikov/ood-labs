import styles from "./editor.module.css"
import {EditorViewData} from "../../model/editor/editor";
import {Toolbar} from "../toolbar/toolbar";
import {Canvas} from "../canvas/canvas";
import {ControllerFunctions} from "../common/controllerFunctions";

interface EditorViewProps {
    data: EditorViewData
    controllerFunctions: ControllerFunctions
}

function Editor(props: EditorViewProps) {
    return <div className={styles.editor}>
        <Toolbar controller={props.controllerFunctions}></Toolbar>
        <Canvas data={props.data} controller={props.controllerFunctions}/>
    </div>
}

export {Editor}
