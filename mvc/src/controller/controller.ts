import {Editor} from "../model/editor/editor";
import {FindShapeTypeByValue} from "../model/shape/shapeType";
import {FindColorByValue} from "../common/color/color";
import {Find} from "../common/utils/find";
import {Point} from "../common/point/point";

class Controller {
    private editor: Editor

    constructor(editor: Editor) {
        this.editor = editor
    }

    SelectShape(id: string | null): void {
        if (id === null) {
            this.editor.SelectShape(null)
        }
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

    MoveShape(topLeft: Point): void {
        this.editor.MoveShape(topLeft)
    }

    ResizeShape(width: number, height: number): void {
        this.editor.ResizeShape(width, height)
    }

    DeleteShape(): void {
        this.editor.DeleteShape()
    }

    Undo(): void {
        this.editor.Undo()
    }

    CanUndo(): boolean {
        return this.editor.CanUndo()
    }

    Redo(): void {
        this.editor.Redo()
    }

    CanRedo(): boolean {
        return this.editor.CanRedo()
    }
}

export {Controller}
