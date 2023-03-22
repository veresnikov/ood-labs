import {Shape} from "../../../../model/shape/shape";
import {ShapeType} from "../../../../model/shape/shapeType";
import {Ellipse as EllipseView} from "./ellipse/ellipse";
import {Rectangle as RectangleView} from "./rectangle/rectangle";
import {Triangle as TriangleView} from "./triangle/triangle";
import {Polyline as PolylineView} from "./polyline/polyline";
import {Ellipse} from "../../../../model/shape/ellipse";
import {Rectangle} from "../../../../model/shape/rectangle";
import {Triangle} from "../../../../model/shape/triangle";
import {ControllerFunctions} from "../../../controller/controllerFunctions";
import {ShapeDrawableProps, ShapeFrameProps} from "../wrapper/wrapper";
import {Polyline} from "../../../../model/shape/polyline";

interface ItemsProps extends ShapeFrameProps, ShapeDrawableProps {
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
                    case ShapeType.Polyline:
                        const polyline = item as Polyline
                        return <PolylineView
                            key={polyline.GetID()}
                            id={polyline.GetID()}
                            polyline={polyline}
                            selectFunc={selectFunc}
                            frame={props.frame}
                            setFrame={props.setFrame}
                            points={props.points}
                        />
                    default:
                        return null
                }
            })}
        </>
    )
}

export {Items}