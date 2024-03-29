import styles from "./toolbar.module.css"
import {Colorpicker} from "./colorpicker/colorpicker";
import {Createshape} from "./createshape/createshape";
import {ControllerFunctions} from "../../controller/controllerFunctions";
import {History} from "./history/history";
import {Menu} from "./menu/menu";
import {useHotKey} from "../../hooks/useHotKey";

interface ToolbarProps {
    controller: ControllerFunctions
}

function Toolbar(props: ToolbarProps) {
    useHotKey(props.controller)
    return <div className={styles.toolbar}>
        <Menu controller={props.controller} />
        <Createshape controller={props.controller}/>
        <Colorpicker setColorFunc={props.controller.SetFillColor} id={'fillcolor'} title={'Fill color:'}/>
        <Colorpicker setColorFunc={props.controller.SetOutlineColor} id={'outlinecolor'} title={'Outline color:'}/>
        <History controller={props.controller} />
    </div>
}

export type {ToolbarProps}
export {Toolbar}
