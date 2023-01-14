import styles from "./createshape.module.css"
import {Createshapebutton} from "./createshapebutton/createshapebutton";
import {ShapeType} from "../../../model/shape/shapeType";
import {ControllerFunctions} from "../../common/controllerFunctions";

interface CreateShapeProps {
    controller: ControllerFunctions
}

function Createshape(props: CreateShapeProps) {
    return (
        <div className={styles.createshape}>
            <h4>Shapes:</h4>
            <>
                {Object.keys(ShapeType).map((shape, index) => {
                    if (isNaN(Number(shape))) {
                        return <Createshapebutton key={index} shape={shape} controller={props.controller}/>
                    }
                })}
            </>
        </div>
    )
}

export type {CreateShapeProps}
export {Createshape}