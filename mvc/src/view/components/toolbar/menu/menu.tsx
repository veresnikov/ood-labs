import styles from "./menu.module.css"
import {ControllerFunctions} from "../../../controller/controllerFunctions";
import {Menubutton} from "./menubutton/menubutton";

interface MenuProps {
    controller: ControllerFunctions
}

function Menu(props: MenuProps) {
    return (
        <div className={styles.menu}>
            <h4>Menu:</h4>
            <Menubutton title={'Delete'} action={props.controller.DeleteShape}/>
        </div>
    )
}

export type {MenuProps}
export {Menu}