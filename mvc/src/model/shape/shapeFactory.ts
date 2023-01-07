import {Shape} from "./shape";
import {Ellipse} from "./ellipse";
import {DefaultValues} from "../../defaultValues";
import {Rectangle} from "./rectangle";
import {Triangle} from "./triangle";
import {ShapeType} from "./shapeType";
import {Uuid} from "../../common/uuid/uuid";

class ShapeFactory {
    static CreateShape(type: ShapeType): Shape {
        let id = Uuid()
        switch (type) {
            // eslint-disable-next-line
            case ShapeType.Ellipse:
                return new Ellipse(
                    id,
                    DefaultValues.defaultCreatePoint,
                    DefaultValues.defaultFrameHeight / 2,
                    DefaultValues.defaultFrameWidth / 2
                )
            // eslint-disable-next-line
            case ShapeType.Rectangle:
                return new Rectangle(
                    id,
                    DefaultValues.defaultCreatePoint,
                    DefaultValues.defaultFrameHeight,
                    DefaultValues.defaultFrameWidth,
                )
            // eslint-disable-next-line
            case ShapeType.Triangle:
                return new Triangle(
                    id,
                    {
                        x: DefaultValues.defaultCreatePoint.x + (DefaultValues.defaultFrameWidth / 2),
                        y: DefaultValues.defaultCreatePoint.y,
                    },
                    {
                        x: DefaultValues.defaultCreatePoint.x + DefaultValues.defaultFrameWidth,
                        y: DefaultValues.defaultCreatePoint.y + DefaultValues.defaultFrameHeight,
                    },
                    {
                        x: DefaultValues.defaultCreatePoint.x,
                        y: DefaultValues.defaultCreatePoint.y + DefaultValues.defaultFrameWidth,
                    },
                )
            default:
                throw new Error("unexpected shape type")
        }
    }
}


export {ShapeFactory}