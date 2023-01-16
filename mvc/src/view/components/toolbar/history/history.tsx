import styles from "./history.module.css"
import {Historybutton} from "./historybutton/historybutton";
import {ControllerFunctions} from "../../../controller/controllerFunctions";

interface HistoryProps {
    controller: ControllerFunctions
}

function History(props: HistoryProps) {
    return (
        <div className={styles.history}>
            <h4>History:</h4>
            <Historybutton actionName={"Undo"} action={props.controller.Undo} isEnabled={props.controller.CanUndo()} />
            <Historybutton actionName={"Redo"} action={props.controller.Redo} isEnabled={props.controller.CanRedo()} />
        </div>
    )
}

export type {HistoryProps}
export {History}