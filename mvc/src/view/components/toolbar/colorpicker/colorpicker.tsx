import styles from "./colorpicker.module.css"
import {Color} from "../../../../common/color/color";
import {Colorbutton} from "./colorbutton/colorbutton";

interface ColorPickerProps {
    id: string
    title: string
    setColorFunc: (color: string) => void
}

function Colorpicker(props: ColorPickerProps) {
    return (
        <div className={styles.colorpicker}>
            <h4>{props.title}</h4>
            <>
                {Object.values(Color).map((color, index) => {
                    return <Colorbutton key={props.id + index} color={color} setColor={props.setColorFunc}/>
                })}
            </>
        </div>
    )
}

export type {ColorPickerProps}
export {Colorpicker}