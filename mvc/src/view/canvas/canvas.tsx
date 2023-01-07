import styles from "./canvas.module.css"
import {EditorViewData} from "../../model/editor/editor";
import {Items} from "./shapes/items";

function Canvas(data: EditorViewData) {
    return <svg className={styles.canvas}>
        <Items items={data.shapes}/>
    </svg>
}

export {Canvas}
