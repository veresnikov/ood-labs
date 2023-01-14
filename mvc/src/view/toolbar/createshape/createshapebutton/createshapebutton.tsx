import styles from "./createshapebutton.module.css"
import {ControllerFunctions} from "../../../common/controllerFunctions";

interface ColorButtonProps {
    shape: string
    controller: ControllerFunctions
}

function Createshapebutton(props: ColorButtonProps) {
    const createShapeFunc = () => {
        props.controller.CreateShape(props.shape)
    }
    return (
        <button
            className={styles.createshapebutton}
            onClick={createShapeFunc}>
            {props.shape}
        </button>
    )
}

export {Createshapebutton}
