import {ControllerFunctions} from "../../../../controller/controllerFunctions";

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
            onClick={createShapeFunc}>
            {props.shape}
        </button>
    )
}

export {Createshapebutton}
