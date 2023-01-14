import {useEffect, useRef} from "react";
import {Ellipse as EllipseModel} from "../../../../model/shape/ellipse";
import {FrameWithId} from "../../canvas";
import {Frame} from "../../../../model/frame/frame";

interface EllipseProps {
    id: string
    ellipse: EllipseModel
    selectFunc: () => void
    setFrame: (frame: FrameWithId | null) => void
    frame: FrameWithId | null
}

function Ellipse(data: EllipseProps) {
    const ref = useRef(null)

    useEffect(() => {
        data.setFrame({
            id: data.id,
            frame: data.ellipse.GetFrame()
        })
    }, [data.ellipse.GetCenter().x, data.ellipse.GetCenter().y])
    const selectFunc = () => {
        data.setFrame({id: data.id, frame: data.ellipse.GetFrame()})
        data.selectFunc()
    }

    const cx = data.id !== data.frame?.id ? data.ellipse.GetCenter().x : data.frame.frame.GetTopLeft().x + data.ellipse.GetWight()
    const cy = data.id !== data.frame?.id ? data.ellipse.GetCenter().y : data.frame.frame.GetTopLeft().y + data.ellipse.GetHeight()
    const rx = data.id !== data.frame?.id ? data.ellipse.GetWight() : data.frame.frame.GetWidth() / 2
    const ry = data.id !== data.frame?.id ? data.ellipse.GetHeight() : data.frame.frame.GetHeight() / 2

    return (
        <ellipse
            ref={ref}
            id={data.id}
            cx={cx}
            cy={cy}
            rx={rx}
            ry={ry}
            fill={data.ellipse.GetFillColor()}
            stroke={data.ellipse.GetOutlineColor()}
            strokeWidth={data.ellipse.GetOutlineThickness()}
            onClick={selectFunc}
        />
    )
}

export {Ellipse}
