import {Shape} from "../../../../model/shape/shape";
import {ShapeType} from "../../../../model/shape/shapeType";
import {Ellipse as EllipseView} from "./ellipse/ellipse";
import {Rectangle as RectangleView} from "./rectangle/rectangle";
import {Triangle as TriangleView} from "./triangle/triangle";
import {Ellipse} from "../../../../model/shape/ellipse";
import {Rectangle} from "../../../../model/shape/rectangle";
import {Triangle} from "../../../../model/shape/triangle";
import {ControllerFunctions} from "../../../controller/controllerFunctions";
import {ShapeFrameProps} from "../wrapper/wrapper";

interface ItemsProps extends ShapeFrameProps {
    items: Shape[]
    controller: ControllerFunctions
}

function Items(props: ItemsProps) {
    return (
        <>
            {props.items.map((item) => {
                const selectFunc = () => {
                    props.controller.SelectShape(item.GetID())
                }
                switch (item.GetType()) {
                    case ShapeType.Ellipse:
                        const ellipse = item as Ellipse
                        return <EllipseView
                            key={ellipse.GetID()}
                            id={ellipse.GetID()}
                            ellipse={ellipse}
                            selectFunc={selectFunc}
                            frame={props.frame}
                            setFrame={props.setFrame}
                        />
                    case ShapeType.Rectangle:
                        const rectangle = item as Rectangle
                        return <RectangleView
                            key={rectangle.GetID()}
                            id={rectangle.GetID()}
                            rectangle={rectangle}
                            selectFunc={selectFunc}
                            frame={props.frame}
                            setFrame={props.setFrame}
                        />
                    case ShapeType.Triangle:
                        const triangle = item as Triangle
                        return <TriangleView
                            key={triangle.GetID()}
                            id={triangle.GetID()}
                            triangle={triangle}
                            selectFunc={selectFunc}
                            frame={props.frame}
                            setFrame={props.setFrame}
                        />
                    default:
                        return null
                }
            })}
        </>
    )
}

export {Items}