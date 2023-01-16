import {Find} from "../../common/utils/find";

enum ShapeType {
    Ellipse = "Ellipse",
    Rectangle = "Rectangle",
    Triangle = "Triangle",
}

function FindShapeTypeByValue(type: string): ShapeType | null {
    let shapeType = Find(Object.values(ShapeType), (t: string) => {
        return t === type
    })
    return (shapeType !== null) ? shapeType as ShapeType : null
}

export {ShapeType, FindShapeTypeByValue}
