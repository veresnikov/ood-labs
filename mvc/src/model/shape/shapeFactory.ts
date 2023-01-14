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
                    {
                        x: DefaultValues.canvasWidth / 2,
                        y: DefaultValues.canvasHeight / 2
                    },
                    DefaultValues.defaultFrameHeight / 2,
                    DefaultValues.defaultFrameWidth / 2
                )
            // eslint-disable-next-line
            case ShapeType.Rectangle:
                return new Rectangle(
                    id,
                    {
                        x: DefaultValues.canvasWidth / 2 - DefaultValues.defaultFrameWidth / 2,
                        y: DefaultValues.canvasHeight / 2 - DefaultValues.defaultFrameHeight / 2
                    },
                    DefaultValues.defaultFrameHeight,
                    DefaultValues.defaultFrameWidth,
                )
            // eslint-disable-next-line
            case ShapeType.Triangle:
                let point = {
                    x: DefaultValues.canvasWidth / 2,
                    y: DefaultValues.canvasHeight / 2
                }
                return new Triangle(
                    id,
                    {
                        x: point.x,
                        y: point.y - DefaultValues.defaultFrameHeight / 2,
                    },
                    {
                        x: point.x + DefaultValues.defaultFrameWidth / 2,
                        y: point.y + DefaultValues.defaultFrameHeight / 2,
                    },
                    {
                        x: point.x - DefaultValues.defaultFrameWidth / 2,
                        y: point.y + DefaultValues.defaultFrameHeight / 2,
                    },
                )
            default:
                throw new Error("unexpected shape type")
        }
    }
}


export {ShapeFactory}