import {RefObject} from "react";
import {Frame} from "../../model/frame/frame";
import {Point} from "../../common/point/point";
import {UseBaseDragAndDrop} from "./base/useBaseDragAndDrop";
import {Normalize} from "../../common/utils/normalize";
import {DefaultValues} from "../../defaultValues";

function useResize(
    ref: RefObject<Element>,
    frame: Frame,
    resizeCallback: (width: number, height: number) => void,
    persistCallback: (width: number, height: number) => void
) {
    const onStart = (_: Point) => {
    }

    const onMove = (delta: Point) => {
        delta.x = Normalize(frame.width + delta.x, 1, DefaultValues.canvasWidth - frame.topLeft.x)
        delta.y = Normalize(frame.height + delta.y, 1, DefaultValues.canvasHeight - frame.topLeft.y)
        resizeCallback(delta.x, delta.y)
    }

    const onEnd = (position: Point) => {
        persistCallback(position.x, position.y)
    }

    UseBaseDragAndDrop(ref, onMove, onEnd, onStart)
}

export {useResize}