import {EditorViewData} from "../../../../model/editor/editor";
import {ControllerFunctions} from "../../../controller/controllerFunctions";
import {useState} from "react";
import {Frame} from "../../../../model/frame/frame";
import {Items} from "../shapes/items";
import {Selected} from "../selected/selected";

interface WrapperProps {
    data: EditorViewData
    controller: ControllerFunctions
}

interface ShapeFrame extends Frame {
    id: string
}

interface ShapeFrameProps {
    setFrame: (frame: ShapeFrame) => void
    frame: ShapeFrame
}

function Wrapper(props: WrapperProps) {
    const [frame, setFrame] = useState<ShapeFrame>({
        id: '',
        topLeft: {x: 0, y: 0},
        width: 0,
        height: 0
    })
    return (
        <>
            <Items
                items={props.data.shapes}
                controller={props.controller}
                frame={frame}
                setFrame={setFrame}
            />
            {
                props.data.selectedShape ?
                    <Selected
                        selectedShape={props.data.selectedShape}
                        controllerFunc={props.controller}
                        frame={frame}
                        setFrame={setFrame}
                    />
                    : null
            }
        </>
    )
}

export type {ShapeFrame, ShapeFrameProps}
export {Wrapper}
