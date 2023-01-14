import {Editor} from "../model/editor/editor";
import {FindShapeTypeByValue} from "../model/shape/shapeType";
import {FindColorByValue} from "../common/color/color";
import {Find} from "../common/enum/find";

class Controller {
    private editor: Editor

    constructor(editor: Editor) {
        this.editor = editor
    }

    SelectShape(id: string): void {
        let shape = Find(this.editor.GetShapes(), (shape) => {
            return shape.GetID() === id
        })
        if (shape !== null) {
            this.editor.SelectShape(shape)
        }
    }

    CreateShape(type: string): void {
        let shapeType = FindShapeTypeByValue(type)
        if (shapeType !== null) {
            this.editor.CreateShape(shapeType)
        }
    }

    SetFillColor(color: string): void {
        let fillColor = FindColorByValue(color)
        if (fillColor !== null) {
            this.editor.SetFillColorShape(fillColor)
        }
    }

    SetOutlineColor(color: string): void {
        let outlineColor = FindColorByValue(color)
        if (outlineColor !== null) {
            this.editor.SetOutlineColorShape(outlineColor)
        }
    }
}

export {Controller}
