import {Shape} from "../../../model/shape/shape";
import {ShapeType} from "../../../model/shape/shapeType";
import {Ellipse as EllipseView} from "./ellipse/ellipse";
import {Rectangle as RectangleView} from "./rectangle/rectangle";
import {Triangle as TriangleView} from "./triangle/triangle";
import {Ellipse} from "../../../model/shape/ellipse";
import {Rectangle} from "../../../model/shape/rectangle";
import {Triangle} from "../../../model/shape/triangle";
import {ControllerFunctions} from "../../common/controllerFunctions";

interface ItemsProps {
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
                            center={ellipse.GetCenter()}
                            height={ellipse.GetHeight()}
                            width={ellipse.GetWight()}
                            fillColor={ellipse.GetFillColor()}
                            outlineColor={ellipse.GetOutlineColor()}
                            outlineThickness={ellipse.GetOutlineThickness()}
                            selectFunc={selectFunc}
                        />
                    case ShapeType.Rectangle:
                        const rectangle = item as Rectangle
                        return <RectangleView
                            key={rectangle.GetID()}
                            id={rectangle.GetID()}
                            topLeft={rectangle.GetTopLeft()}
                            height={rectangle.GetHeight()}
                            width={rectangle.GetWight()}
                            fillColor={rectangle.GetFillColor()}
                            outlineColor={rectangle.GetOutlineColor()}
                            outlineThickness={rectangle.GetOutlineThickness()}
                            selectFunc={selectFunc}
                        />
                    case ShapeType.Triangle:
                        const triangle = item as Triangle
                        return <TriangleView
                            key={triangle.GetID()}
                            id={triangle.GetID()}
                            vertex1={triangle.GetVertex1()}
                            vertex2={triangle.GetVertex2()}
                            vertex3={triangle.GetVertex3()}
                            fillColor={triangle.GetFillColor()}
                            outlineColor={triangle.GetOutlineColor()}
                            outlineThickness={triangle.GetOutlineThickness()}
                            selectFunc={selectFunc}
                        />
                    default:
                        return null
                }
            })}
        </>
    )
}

export {Items}