import styles from "./editor.module.css"
import {EditorViewData} from "../../model/editor/editor";
import {Toolbar} from "../toolbar/toolbar";
import {Canvas} from "../canvas/canvas";

function Editor(data: EditorViewData) {
    return <div className={styles.editor}>
        <Toolbar></Toolbar>
        <Canvas selectedShape={data.selectedShape} shapes={data.shapes}></Canvas>
    </div>
}

export {Editor}
